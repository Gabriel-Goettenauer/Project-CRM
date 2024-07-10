<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funnel;

class FunnelController extends Controller
{
    // List all funnels
    public function index()
    {
        $funnels = Funnel::all();
        return response()->json($funnels);
    }

    // Store a new funnel
    public function store(Request $request)
    {
        $funnel = Funnel::create($request->all());
        return response()->json($funnel, 201);
    }

    // Show a specific funnel
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
}
