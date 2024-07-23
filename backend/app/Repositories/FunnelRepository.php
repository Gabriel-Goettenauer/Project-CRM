<?php

namespace App\Repositories;

use App\Models\Funnel;
use Illuminate\Database\Eloquent\Collection;

class FunnelRepository
{
    public function getAll(): Collection
    {
        return Funnel::all();
    }

    public function create(array $data): Funnel
    {
        return Funnel::create($data);
    }

    public function findById($id): Funnel
    {
        return Funnel::findOrFail($id);
    }

    public function update($id, array $data): Funnel
    {
        $funnel = $this->findById($id);
        $funnel->update($data);
        return $funnel;
    }

    public function delete($id): void
    {
        $funnel = $this->findById($id);
        $funnel->delete();
    }

    public function searchByName($name): Collection
    {
        return Funnel::where('name', 'like', "%$name%")->get();
    }

    public function getFunnelDetails($id, $perPage = 15): Funnel
    {
        return Funnel::with(['stages' => function ($query) use ($perPage) {
            $query->paginate($perPage);
        }, 'stages.contacts'])->findOrFail($id);
    }
}
