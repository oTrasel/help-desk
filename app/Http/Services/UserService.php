<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;

class UserService
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function create($id_role, $name, $email, $password)
    {
        return $this->userRepository->create($id_role, $name, $email, $password);
    }

}