<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funnel;

class FunnelController extends Controller
{
    public function index()
    {
        // Paginação de 15 registros por página
        $funnels = Funnel::paginate(15);
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


    public function showFunnelDetails($id)
    {
        $funnel = Funnel::with(['stages' => function ($query) {
            $query->paginate(15); // Paginação de 15 registros por página
        }, 'stages.contacts'])->findOrFail($id);

        return response()->json($funnel);
    }
}
