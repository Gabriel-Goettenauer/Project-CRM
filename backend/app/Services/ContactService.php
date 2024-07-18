<?php

namespace App\Services;

use App\Repositories\ContactRepository;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;

class ContactService
{
    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getAllContacts($perPage = 15)
    {
        return $this->contactRepository->getAll();
    }

    public function createContact(array $data): Contact
    {
        return $this->contactRepository->create($data);
    }

    public function getContactById($id): Contact
    {
        return $this->contactRepository->findById($id);
    }

    public function updateContact($id, array $data): Contact
    {
        return $this->contactRepository->update($id, $data);
    }

    public function deleteContact($id): void
    {
        $this->contactRepository->delete($id);
    }

    public function getContactsByStage($stageId): Collection
    {
        return $this->contactRepository->getByStage($stageId);
    }
}
