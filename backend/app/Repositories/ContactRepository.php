<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ContactRepository
{
    public function getAll(): Collection
    {
        return Contact::orderBy('position')->get();
    }

    public function create(array $data): Contact
    {
        return Contact::create($data);
    }

    public function findById($id): Contact
    {
        return Contact::findOrFail($id);
    }

    public function update($id, array $data): Contact
    {
        $contact = $this->findById($id);
        $contact->update($data);
        return $contact;
    }

    public function delete($id): void
    {
        $contact = $this->findById($id);
        $contact->delete();
    }

    public function searchByName($name): Collection
    {
        return Contact::where('name', 'like', "%$name%")->get();
    }

    public function getByStage($stageId): Collection
    {
        return Contact::where('stage_id', $stageId)->get();
    }

    public function updateStage($contactId, $stageId): void
    {
        $contact = $this->findById($contactId);
        $contact->stage_id = $stageId;
        $contact->save();
    }

    public function updatePosition($start, $end, $increment): void
    {
        Contact::whereBetween('position', [$start, $end])
            ->update(['position' => DB::raw("position $increment")]);
    }
}
