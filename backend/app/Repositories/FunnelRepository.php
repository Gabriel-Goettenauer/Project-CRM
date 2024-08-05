<?php
namespace App\Repositories;

use App\Models\Funnel;
use Illuminate\Pagination\LengthAwarePaginator;

class FunnelRepository
{
    public function getAll($perPage = 11): LengthAwarePaginator
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

    public function searchByName($name, $perPage = 15): LengthAwarePaginator
    {
        return Funnel::where('name', 'like', "%$name%")->paginate($perPage);
    }

    public function getFunnelDetails($id, $perPage = 15): LengthAwarePaginator
    {
        $funnel = Funnel::findOrFail($id);
        return $funnel->stages()->paginate($perPage);
    }
    
    public function findAll($perPage = 11)
    {
        return Funnel::paginate($perPage);
    }
    public function findByUserId($userId, $perPage = 11)
    {
        return Funnel::where('user_id', $userId)->paginate($perPage);
    }
}
