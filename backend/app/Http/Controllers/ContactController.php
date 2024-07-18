<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContactService;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        $contacts = $this->contactService->getAllContacts();
        return response()->json($contacts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'cpf' => 'required|string|max:14|unique:contacts,cpf',
            'date_of_birth' => 'required|date',
            'value' => 'required|numeric',
            'address' => 'required|string|max:255', // Validação do campo de endereço
            'stage_id' => 'required|exists:stages,id',
        ]);

        $contact = $this->contactService->createContact($request->all());
        return response()->json($contact, 201);
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
            'phone' => 'required|string|max:20',
            'cpf' => 'required|string|max:14|unique:contacts,cpf,' . $id,
            'date_of_birth' => 'required|date',
            'value' => 'required|numeric',
            'address' => 'required|string|max:255', // Validação do campo de endereço
            'stage_id' => 'required|exists:stages,id',
        ]);

        $contact = $this->contactService->updateContact($id, $request->all());
        return response()->json($contact);
    }

    public function destroy($id)
    {
        $this->contactService->deleteContact($id);
        return response()->json(null, 204);
    }
}
