<?php

namespace App\Http\Repositories;

use App\Http\Models\UserModel;

class UserRepository
{
    public function create($id_role, $name, $email, $password)
    {
        $user = UserModel::create([
            "id_role" => $id_role,
            "name" => $name,
            "email" => $email,
            "password" => bcrypt($password),
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $user->save();
        return $user;
    }

}