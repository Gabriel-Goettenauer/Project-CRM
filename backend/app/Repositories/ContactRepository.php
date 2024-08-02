<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;

class ContactRepository
{
    /**
     * Obtém todos os contatos ordenados por posição.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Contact::orderBy('position')->get(); // Ordena os contatos por posição diretamente na consulta
    }

    /**
     * Cria um novo contato.
     *
     * @param array $data
     * @return Contact
     */
    public function create(array $data): Contact
    {
        return Contact::create($data);
    }

    /**
     * Encontra um contato pelo ID.
     *
     * @param int $id
     * @return Contact
     */
    public function findById($id): Contact
    {
        return Contact::findOrFail($id);
    }

    /**
     * Atualiza um contato existente.
     *
     * @param int $id
     * @param array $data
     * @return Contact
     */
    public function update($id, array $data): Contact
    {
        $contact = $this->findById($id);
        $contact->update($data);
        return $contact;
    }

    /**
     * Exclui um contato pelo ID.
     *
     * @param int $id
     * @return void
     */
    public function delete($id): void
    {
        $contact = $this->findById($id);
        $contact->delete();
    }

    /**
     * Pesquisa contatos pelo nome.
     *
     * @param string $name
     * @return Collection
     */
    public function searchByName($name): Collection
    {
        return Contact::where('name', 'like', "%$name%")->get();
    }

    /**
     * Obtém contatos por estágio.
     *
     * @param int $stageId
     * @return Collection
     */
    public function getByStage($stageId): Collection
    {
        return Contact::where('stage_id', $stageId)->get();
    }

    /**
     * Atualiza o estágio de um contato.
     *
     * @param int $contactId
     * @param int $stageId
     * @return void
     */
    public function updateStage($contactId, $stageId): void
    {
        $contact = $this->findById($contactId);
        $contact->stage_id = $stageId;
        $contact->save();
    }

    /**
     * Atualiza a posição de um contato.
     *
     * @param int $contactId
     * @param int $position
     * @return void
     */
    // public function updatePosition($contactId, $position): void
    // {
    //     $contact = $this->findById($contactId);
    //     $contact->position = $position;
    //     $contact->save();
    // }
    public function updatePosition($start, $end, $increment)
    {
        Contact::whereBetween('position', [$start, $end])
            ->update(['position' => \DB::raw("position $increment")]);
    }
}
