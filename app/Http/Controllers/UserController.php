<?php

namespace App\Http\Controllers;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Services\UserService;
// use App\Http\Enums\UserRolesEnum;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(CreateUserRequest $request)
    {
        return $this->userService->create(
            $request->id_role,
            $request->name,
            $request->email,
            $request->password
            
        );
    }

}