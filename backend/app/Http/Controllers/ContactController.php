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
        $stageId = $request->input('stage_id'); // Obtém o stage_id dos parâmetros da requisição

        if ($stageId) {
            $contacts = $this->contactService->getContactsByStage($stageId);
        } else {
            // Se nenhum stage_id fornecido, retorna todos os contatos
            $contacts = $this->contactService->getAllContacts();
        }

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

        $phoneNumber = $request->input('phone');

        // Validar e formatar número de telefone
        if (!$this->phoneNumberService->validatePhoneNumber($phoneNumber)) {
            return response()->json(['error' => 'Número de telefone inválido.'], 400);
        }

        try {
            $formattedPhoneNumber = $this->phoneNumberService->formatPhoneNumber($phoneNumber);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $contactData = $request->all();
        $contactData['phone'] = $formattedPhoneNumber;

        $contact = $this->contactService->createContact($contactData);
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

        $phoneNumber = $request->input('phone');

        // Validar e formatar número de telefone
        if (!$this->phoneNumberService->validatePhoneNumber($phoneNumber)) {
            return response()->json(['error' => 'Número de telefone inválido.'], 400);
        }

        try {
            $formattedPhoneNumber = $this->phoneNumberService->formatPhoneNumber($phoneNumber);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $contactData = $request->all();
        $contactData['phone'] = $formattedPhoneNumber;

        $contact = $this->contactService->updateContact($id, $contactData);
        return response()->json($contact);
    }

    public function destroy($id)
    {
        $this->contactService->deleteContact($id);
        return response()->json(null, 204);
    }
}
