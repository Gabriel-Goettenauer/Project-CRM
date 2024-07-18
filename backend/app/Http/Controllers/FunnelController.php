<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FunnelService;

class FunnelController extends Controller
{
    protected $funnelService;

    public function __construct(FunnelService $funnelService)
    {
        $this->funnelService = $funnelService;
    }

    public function index()
    {
        $funnels = $this->funnelService->getAllFunnels();
        return response()->json($funnels);
    }

    public function store(Request $request)
    {
        $funnel = $this->funnelService->createFunnel($request->all());
        return response()->json($funnel, 201);
    }

    public function show($id)
    {
        $funnel = $this->funnelService->getFunnelById($id);
        return response()->json($funnel);
    }

    public function update(Request $request, $id)
    {
        $funnel = $this->funnelService->updateFunnel($id, $request->all());
        return response()->json($funnel);
    }

    public function destroy($id)
    {
        $this->funnelService->deleteFunnel($id);
        return response()->json(null, 204);
    }

    public function showFunnelDetails($id)
    {
        $funnel = $this->funnelService->getFunnelDetails($id);
        return response()->json($funnel);
    }
}
