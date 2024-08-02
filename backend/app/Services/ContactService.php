<?php

namespace App\Services;

use App\Repositories\ContactRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContactService
{
    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getContacts()
    {
        return $this->contactRepository->getAll();
    }

    public function getContactsByStage($stageId)
    {
        return $this->contactRepository->getByStage($stageId);
    }

    public function createContact(array $data)
    {
        $this->updatePositionsOnCreate();
        $data['position'] = 0;
        return $this->contactRepository->create($data);
    }

    public function getContactById($id)
    {
        return $this->contactRepository->findById($id);
    }

    public function updateContact($id, array $data)
    {
        return $this->contactRepository->update($id, $data);
    }

    public function deleteContact($id)
    {
        $this->contactRepository->delete($id);
        $this->reorderPositions();
    }

    public function updateStage($contactId, $stageId)
    {
        $this->contactRepository->updateStage($contactId, $stageId);
    }

    public function updatePosition($stage_id, $new_position)
    {
        $contato = $this->contactRepository->findById($stage_id);
        if (!$contato) {
            throw new ModelNotFoundException('Contato não encontrado.');
        }

        $current_position = $contato->position;

        if ($new_position == $current_position) {
            return;
        }

        if ($new_position > $current_position) {
            $this->contactRepository->updatePosition($current_position + 1, $new_position, '- 1');
        } else {
            $this->contactRepository->updatePosition($new_position, $current_position - 1, '+ 1');
        }

        $contato->position = $new_position;
        $contato->save();
    }

    protected function updatePositionsOnCreate(): void
    {
        $contacts = $this->contactRepository->getAll();
        foreach ($contacts as $contact) {
            $contact->position++;
            $contact->save();
        }
    }

    protected function reorderPositions(): void
    {
        $contacts = $this->contactRepository->getAll()->sortBy('position');
        $position = 1;
        foreach ($contacts as $contact) {
            $contact->position = $position++;
            $contact->save();
        }
    }
}
