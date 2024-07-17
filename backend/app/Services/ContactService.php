<?php

namespace App\Services;

use App\Repositories\ContactRepository;

class ContactService
{
    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function create(array $data)
    {
        return $this->contactRepository->create($data);
    }

    public function update($id, array $data)
    {
        $contact = $this->contactRepository->findById($id);
        return $this->contactRepository->update($contact, $data);
    }

    public function delete($id)
    {
        $contact = $this->contactRepository->findById($id);
        $this->contactRepository->delete($contact);
    }

    public function getAll()
    {
        return $this->contactRepository->getAll();
    }

    public function getById($id)
    {
        return $this->contactRepository->findById($id);
    }
}
