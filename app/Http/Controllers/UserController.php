<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;

class UserController extends Controller
{
    private $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function index()
    {
        $users['data'] = $this->repository->all();
        return response()->json($users, 200);
    }

}
