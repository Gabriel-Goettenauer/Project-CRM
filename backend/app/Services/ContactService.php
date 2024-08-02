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
        $this->updatePositionsOnCreate(); // Atualiza as posições antes de criar um novo contato
        $data['position'] = 0; // Define a posição inicial do novo contato
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
        $this->reorderPositions(); // Reordena posições após excluir um contato
    }

    // public function updateStage($contactId, $stageId)
    // {
    //     $this->contactRepository->updateStage($contactId, $stageId);
    // }

    // public function updatePosition($contactId, $position): void
    // {
    //     $this->contactRepository->updatePosition($contactId, $position);
    //     $this->reorderPositions(); // Reordena posições após atualizar uma posição
    // }
    public function updatePosition($stage_id, $new_position)
    {
        $contato = $this->contactRepository->findByStageId($stage_id);
        if (!$contato) {
            return response()->json(['error' => 'Contato não encontrado.'], 404);
        }

        $current_position = $contato->position;

        if ($new_position == $current_position) {
            return response()->json(['message' => 'A nova posição é igual à posição atual.'], 200);
        }

        if ($new_position > $current_position) {
            $this->contactRepository->updatePositions($current_position + 1, $new_position, '- 1');
        } elseif ($new_position < $current_position) {
            $this->contactRepository->updatePositions($new_position, $current_position - 1, '+ 1');
        }

        $contato->position = $new_position;
        $contato->save();

        return response()->json($contato, 200);
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
