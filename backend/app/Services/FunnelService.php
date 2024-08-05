<?php
namespace App\Services;

use App\Repositories\FunnelRepository;
use App\Models\Funnel;
use Illuminate\Pagination\LengthAwarePaginator;

class FunnelService
{
    protected $funnelRepository;

    public function __construct(FunnelRepository $funnelRepository)
    {
        $this->funnelRepository = $funnelRepository;
    }

    public function getAllFunnels($perPage = 11)
    {
        return $this->funnelRepository->findAll($perPage);
    }

    public function createFunnel(array $data): Funnel
    {
        return $this->funnelRepository->create($data);
    }

    public function getFunnelById($id,$perPage = 11): Funnel
    {
        return $this->funnelRepository->findById($id);
    }

    public function updateFunnel($id, array $data): Funnel
    {
        return $this->funnelRepository->update($id, $data);
    }

    public function deleteFunnel($id): void
    {
        $this->funnelRepository->delete($id);
    }

    public function getFunnelDetails($id, $perPage = 15): LengthAwarePaginator
    {
        return $this->funnelRepository->getFunnelDetails($id, $perPage);
    }

    public function searchFunnelsByName($name, $perPage = 15): LengthAwarePaginator
    {
        return $this->funnelRepository->searchByName($name, $perPage);
    }

    public function getFunnelsByUserId($userId, $perPage = 11)
    {
        return $this->funnelRepository->findByUserId($userId, $perPage);
    }
}
