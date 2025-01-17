<?php

namespace App\Repositories;

use App\Models\Stage;

class StageRepository
{
    public function getAll()
    {
        return Stage::all();
    }

    public function getByFunnelId($funnelId)
    {
        return Stage::where('funnel_id', $funnelId)->get();
    }

    public function create(array $data)
    {
        return Stage::create($data);
    }

    public function findById($id)
    {
        return Stage::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $stage = $this->findById($id);
        $stage->update($data);
        return $stage;
    }

    public function delete($id)
    {
        $stage = $this->findById($id);
        $stage->delete();
    }
}
