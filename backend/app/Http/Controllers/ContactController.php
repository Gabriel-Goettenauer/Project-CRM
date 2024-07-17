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
        $contacts = $this->contactService->getAll();
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|string|email|max:150|unique:contacts,email',
            'phone' => 'required|string|max:15',
            'cpf' => 'required|string|max:14|unique:contacts,cpf',
            'date_of_birth' => 'required|date',
            'value' => 'required|numeric',
            'stage_id' => 'required|exists:stages,id',
        ]);

        $this->contactService->create($request->all());

        return redirect()->route('contacts.index');
    }

    public function show($id)
    {
        $contact = $this->contactService->getById($id);
        return view('contacts.show', compact('contact'));
    }

    public function edit($id)
    {
        $contact = $this->contactService->getById($id);
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|string|email|max:150|unique:contacts,email,' . $id,
            'phone' => 'required|string|max:15',
            'cpf' => 'required|string|max:14|unique:contacts,cpf,' . $id,
            'date_of_birth' => 'required|date',
            'value' => 'required|numeric',
            'stage_id' => 'required|exists:stages,id',
        ]);

        $this->contactService->update($id, $request->all());

        return redirect()->route('contacts.index');
    }

    public function destroy($id)
    {
        $this->contactService->delete($id);

        return redirect()->route('contacts.index');
    }
}
