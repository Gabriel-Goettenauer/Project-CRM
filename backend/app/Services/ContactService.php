<?php

namespace App\Services;

use App\Repositories\ContactRepository;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;

class ContactService
{
    protected $contactRepository;
    protected $phoneNumberService;

    public function __construct(ContactRepository $contactRepository, PhoneNumberService $phoneNumberService)
    {
        $this->contactRepository = $contactRepository;
        $this->phoneNumberService = $phoneNumberService;
    }

    public function getAllContacts($perPage = 15)
    {
        return $this->contactRepository->getAll();
    }

    public function createContact(array $data): Contact
    {
        // Validar o número de telefone
        if (!$this->phoneNumberService->validatePhoneNumber($data['ddd_location'], $data['phone'])) {
            throw new \Exception('Número de telefone inválido.');
        }

        // Formatar o número de telefone
        $data['phone'] = $this->phoneNumberService->formatPhoneNumber($data['ddd_location'], $data['phone']);

        return $this->contactRepository->create($data);
    }

    public function getContactById($id): Contact
    {
        return $this->contactRepository->findById($id);
    }

    public function updateContact($id, array $data): Contact
    {
        // Validar o número de telefone
        if (isset($data['ddd_location']) && isset($data['phone']) &&
            !$this->phoneNumberService->validatePhoneNumber($data['ddd_location'], $data['phone'])) {
            throw new \Exception('Número de telefone inválido.');
        }

        // Formatar o número de telefone
        if (isset($data['ddd_location']) && isset($data['phone'])) {
            $data['phone'] = $this->phoneNumberService->formatPhoneNumber($data['ddd_location'], $data['phone']);
        }

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

    public function getContacts(): Collection
    {
        return $this->contactRepository->getAll();
    }
}
