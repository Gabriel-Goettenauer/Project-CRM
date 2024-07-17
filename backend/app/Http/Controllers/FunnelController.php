<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funnel;

class FunnelController extends Controller
{
    public function index()
    {
        $funnels = Funnel::all();
        return response()->json($funnels);
    }

    public function store(Request $request)
    {
        $funnel = Funnel::create($request->all());
        return response()->json($funnel, 201);
    }

    public function show($id)
    {
        $funnel = Funnel::findOrFail($id);
        return response()->json($funnel);
    }

    public function update(Request $request, $id)
    {
        $funnel = Funnel::findOrFail($id);
        $funnel->update($request->all());
        return response()->json($funnel);
    }

    public function destroy($id)
    {
        $funnel = Funnel::findOrFail($id);
        $funnel->delete();
        return response()->json(null, 204);
    }

    // Método criado para obter as etapas e contatos de um funil específico
    public function showFunnelDetails($id)
    {
        $funnel = Funnel::with('stages.contacts')->findOrFail($id);
        return response()->json($funnel);
    }
}
