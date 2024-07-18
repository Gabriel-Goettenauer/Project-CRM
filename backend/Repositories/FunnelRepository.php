<?php

namespace App\Repositories;

use App\Models\Funnel;

class FunnelRepository
{
    public function getAll($perPage = 15)
    {
        return Funnel::paginate($perPage);
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

    public function getFunnelDetails($id, $perPage = 15)
    {
        return Funnel::with(['stages' => function ($query) use ($perPage) {
            $query->paginate($perPage);
        }, 'stages.contacts'])->findOrFail($id);
    }
}
