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

    public function index(Request $request)
    {
        $userId = $request->query('user_id'); // Pega o user_id da query string
        $perPage = $request->query('perPage', 11); // Valor padrão de 11 por página, pode ser alterado na requisição

        if ($userId) {
            // Se user_id for fornecido, busca funis por user_id
            $funnels = $this->funnelService->getFunnelsByUserId($userId, $perPage);
        } else {
            // Caso contrário, retorna todos os funis
            $funnels = $this->funnelService->getAllFunnels($perPage);
        }

        return response()->json($funnels);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id', // Validação para user_id
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
                'user_id' => 'sometimes|required|exists:users,id', // Validação opcional para user_id
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
        $perPage = $request->query('perPage', 15); // Valor padrão de 15 por página, pode ser alterado na requisição
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
        $perPage = $request->query('perPage', 15); // Valor padrão de 15 por página, pode ser alterado na requisição

        $funnels = $this->funnelService->searchFunnelsByName($name, $perPage);
        return response()->json($funnels);
    }
}
