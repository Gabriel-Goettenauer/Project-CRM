<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create(array $data)
    {
        return User::create($data);
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function findOrFailByEmail($email)
    {
        return User::where('email', $email)->firstOrFail();
    }
}


/**
 * Lembrar dos Padroes de Projeto das aulas da Faculdade. 
 * MVC
 * Controller sem lógica, Repósitory parte de banco, Services para a parte lógica da aplicação.
 * Prática comum em arquitetura de software,
 * especialmente quando se utiliza o padrão de projeto Repository.
 * 
 */