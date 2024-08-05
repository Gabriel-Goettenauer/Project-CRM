<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FunnelService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FunnelController extends Controller
{
    protected $funnelService;

    public function __construct(FunnelService $funnelService)
    {
        $this->funnelService = $funnelService;
    }

    public function index($userId, Request $request)
    {
        $perPage = 11;

        if ($userId) {
            $funnels = $this->funnelService->getFunnelsByUserId($userId, $perPage);
        } else {
            $funnels = $this->funnelService->getAllFunnels($perPage);
        }

        return response()->json($funnels);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $funnel = $this->funnelService->createFunnel($request->all());
        return response()->json($funnel, 201);
    }

    public function show($id)
    {
        try {
            $funnel = $this->funnelService->getFunnelById($id);
            return response()->json($funnel);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Funnel not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'user_id' => 'sometimes|required|exists:users,id',
            ]);

            $funnel = $this->funnelService->updateFunnel($id, $request->all());
            return response()->json($funnel);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Funnel not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->funnelService->deleteFunnel($id);
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Funnel not found'], 404);
        }
    }

    public function showFunnelDetails($id, Request $request)
    {
        $perPage = $request->query('perPage', 15);
        try {
            $funnelDetails = $this->funnelService->getFunnelDetails($id, $perPage);
            return response()->json($funnelDetails);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Funnel not found'], 404);
        }
    }

    public function searchByName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $name = $request->input('name');
        $perPage = $request->query('perPage', 15);
        $funnels = $this->funnelService->searchFunnelsByName($name, $perPage);
        return response()->json($funnels);
    }
}
