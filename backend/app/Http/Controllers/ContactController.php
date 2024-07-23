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
            'email' => 'required|email|max:255|unique:contacts',
            'phone' => 'required|string|max:15',
            'ddd_location' => 'required|string|size:2',
            'cpf' => 'nullable|string|max:14',
            'birthdate' => 'nullable|date',
            'value' => 'nullable|numeric',
            'address' => 'required',
            'date_of_birth' => 'required',
            'stage_id' => 'required'
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
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255|unique:contacts,email,' . $id,
            'phone' => 'sometimes|required|string|max:15',
            'ddd_location' => 'sometimes|required|string|size:2',
            'cpf' => 'sometimes|nullable|string|max:14',
            'birthdate' => 'sometimes|nullable|date',
            'value' => 'sometimes|nullable|numeric'
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
