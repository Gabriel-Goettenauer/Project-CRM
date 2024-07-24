<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContactService;
use App\Services\PhoneNumberService;

class ContactController extends Controller
{
    protected $contactService;
    protected $phoneNumberService;

    public function __construct(ContactService $contactService, PhoneNumberService $phoneNumberService)
    {
        $this->contactService = $contactService;
        $this->phoneNumberService = $phoneNumberService;
    }

    public function indexByStage(Request $request)
    {
        $stageId = $request->input('stage_id');
        $contacts = $this->contactService->getContactsByStage($stageId);
        return response()->json($contacts);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'ddd_location' => 'required|string|max:2',
            'phone' => 'required|string|max:20',
            'cpf' => 'required|string|max:14|unique:contacts,cpf',
            'date_of_birth' => 'required|date',
            'value' => 'required|numeric',
            'address' => 'required|string|max:255', // Validação do campo de endereço
            'stage_id' => 'required|exists:stages,id',
        ]);

        try {
            $contact = $this->contactService->createContact($validated);
            return response()->json($contact, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        $contact = $this->contactService->getContactById($id);
        return response()->json($contact);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'ddd_location' => 'required|string|max:2',
            'phone' => 'required|string|max:20',
            'cpf' => 'required|string|max:14|unique:contacts,cpf,' . $id,
            'date_of_birth' => 'required|date',
            'value' => 'required|numeric',
            'address' => 'required|string|max:255', // Validação do campo de endereço
            'stage_id' => 'required|exists:stages,id',

        ]);

        try {
            $contact = $this->contactService->updateContact($id, $validated);
            return response()->json($contact);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        $this->contactService->deleteContact($id);
        return response()->json(null, 204);
    }
}
