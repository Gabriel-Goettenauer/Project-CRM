<?php

namespace App\Http\Controllers;

use App\Models\PersonalAccessToken;
use Illuminate\Http\Request;

class PersonalAccessTokenController extends Controller
{
    public function index()
    {
        $tokens = PersonalAccessToken::all();
        return view('personal_access_tokens.index', compact('tokens'));
    }

    public function create()
    {
        return view('personal_access_tokens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:200',
            'phone' => 'required|string|max:18',
            'email' => 'required|string|email|max:20',
        ]);

        PersonalAccessToken::create($request->all());
        return redirect()->route('personalAccessTokens.index');
    }

    public function show($id)
    {
        $token = PersonalAccessToken::findOrFail($id);
        return view('personal_access_tokens.show', compact('token'));
    }

    public function edit($id)
    {
        $token = PersonalAccessToken::findOrFail($id);
        return view('personal_access_tokens.edit', compact('token'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255',
        ]);

        $token = PersonalAccessToken::findOrFail($id);
        $token->update($request->all());
        return redirect()->route('personalAccessTokens.index');
    }

    public function destroy($id)
    {
        $token = PersonalAccessToken::findOrFail($id);
        $token->delete();
        return redirect()->route('personalAccessTokens.index');
    }
}
