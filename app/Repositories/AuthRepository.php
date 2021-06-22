<?php

namespace App\Repositories;

use App\Repositories\CrudRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AuthRepository extends CrudRepository
{
    protected $model;

    public function __construct()
    {
    }
}
