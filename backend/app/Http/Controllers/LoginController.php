<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        $logins = Login::all();
        return view('logins.index', compact('logins'));
    }

    public function create()
    {
        return view('logins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'dateOfBirth' => 'required|date',
            'cpf' => 'required|string|max:14|unique:login,cpf',
            'email' => 'required|string|email|max:200|unique:login,email',
        ]);

        Login::create($request->all());
        return response()->json("LOgin feito", 201);
    }

    public function show($id)
    {
        $login = Login::findOrFail($id);
        return view('logins.show', compact('login'));
    }

    public function edit($id)
    {
        $login = Login::findOrFail($id);
        return view('logins.edit', compact('login'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_completo' => 'required|string|max:200',
            'data_de_nascimento' => 'required|date',
            'cpf' => 'required|string|max:14|unique:login,cpf,' . $id,
            'email' => 'required|string|email|max:200|unique:login,email,' . $id,
        ]);

        $login = Login::findOrFail($id);
        $login->update($request->all());
        return redirect()->route('logins.index');
    }

    public function destroy($id)
    {
        $login = Login::findOrFail($id);
        $login->delete();
        return redirect()->route('logins.index');
    }
}
