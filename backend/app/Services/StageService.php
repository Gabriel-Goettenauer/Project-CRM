<?php

namespace App\Services;

use App\Repositories\StageRepository;

class StageService
{
    protected $stageRepository;

    public function __construct(StageRepository $stageRepository)
    {
        $this->stageRepository = $stageRepository;
    }

    public function getAllStages()
    {
        return $this->stageRepository->getAll();
    }

    public function getStagesByFunnel($funnelId)
    {
        return $this->stageRepository->getByFunnelId($funnelId);
    }

    public function createStage(array $data)
    {
        return $this->stageRepository->create($data);
    }

    public function getStageById($id)
    {
        return $this->stageRepository->findById($id);
    }

    public function updateStage($id, array $data)
    {
        return $this->stageRepository->update($id, $data);
    }

    public function deleteStage($id)
    {
        $this->stageRepository->delete($id);
    }
}
