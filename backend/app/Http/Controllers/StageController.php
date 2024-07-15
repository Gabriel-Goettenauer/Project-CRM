<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;

class StageController extends Controller
{
    public function index()
    {
        $stages = Stage::all();
        return response()->json($stages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'funnel_id' => 'required|exists:funnels,id',
        ]);
        $stage = Stage::create($request->all());
        return response()->json($stage, 201);
    }

    public function show($id)
    {
        $stage = Stage::findOrFail($id);
        return response()->json($stage);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'funnel_id' => 'required|exists:funnels,id',
        ]);
        $stage = Stage::findOrFail($id);
        $stage->update($request->all());
        return response()->json($stage);
    }

    public function destroy($id)
    {
        $stage = Stage::findOrFail($id);
        $stage->delete();
        return response()->json(null, 204);
    }
}
