<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class UsersController extends CrudController
{
    public function __construct()
    {
        // $this->middleware('auth:api');
        $this->repository = new UsersRepository();
    }

    public function index(Request $request)
    {
        $response = parent::index($request);
    }

    public function store(Request $request)
    {
        $resu = false;
        $validator = Validator::make(
            $request->all(),
            [
                'nome' => 'required|max:100',
                'sobrenome' => 'required|max:100',
                'login' => 'required|max:100',
                'password' => 'required',
                'email' => 'required|max:180'
            ]
        );

        if (!$validator->fails()) {
            $request['password'] = Hash::make($request['password']);
            $resu = $this->repository->create($request->all());
        }

        return response()->json(['message' => ($resu ? 'Usuário cadastrado com sucesso' : 'Não conseguimos cadastrar o usuário')]);
    }
}
