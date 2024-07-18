<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    public function create(array $data)
    {
        return Contact::create($data);
    }

    public function update(Contact $contact, array $data)
    {
        $contact->update($data);
        return $contact;
    }

    public function delete(Contact $contact)
    {
        $contact->delete();
    }

    public function findById($id)
    {
        return Contact::findOrFail($id);
    }

    public function getAll()
    {
        return Contact::all();
    }
}
