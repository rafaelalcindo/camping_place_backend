<?php

namespace App\Repositories;

use App\Repositories\CrudRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Model\User;


class UsersRepository extends CrudRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }
}
