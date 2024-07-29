<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StageService;

class StageController extends Controller
{
    protected $stageService;

    public function __construct(StageService $stageService)
    {
        $this->stageService = $stageService;
    }

    public function index(Request $request)
    {
        $funnelId = $request->input('funnel_id');
        $stages = $this->stageService->getStagesByFunnel($funnelId);
        return response()->json($stages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'funnel_id' => 'required|exists:funnels,id',
            'user_color' => 'required|string'
        ]);
        $stage = $this->stageService->createStage($request->all());
        return response()->json($stage, 201);
    }

    public function show($id)
    {
        $stage = $this->stageService->getStageById($id);
        return response()->json($stage);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'funnel_id' => 'required|exists:funnels,id',
            'user_color' => 'required|string'
        ]);
        $stage = $this->stageService->updateStage($id, $request->all());
        return response()->json($stage);
    }

    public function destroy($id)
    {
        $this->stageService->deleteStage($id);
        return response()->json(null, 204);
    }
}
