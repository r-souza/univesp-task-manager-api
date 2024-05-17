<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    protected $model;

    /**
     * UserRepository constructor
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getByEmail($email)
    {
        return $this->model->active()->where('email', '=', $email)->first();
    }
}
