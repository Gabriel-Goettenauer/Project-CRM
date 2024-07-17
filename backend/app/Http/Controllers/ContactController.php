<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
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

        Contact::create($request->all());

        return redirect()->route('contacts.index');
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
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

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());

        return redirect()->route('contacts.index');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index');
    }
}
