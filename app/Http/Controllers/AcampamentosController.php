<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AcampamentosRepository;
use App\Model\Acampamento;

class AcampamentosController extends CrudController
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'view']]);
        $this->repository = new AcampamentosRepository();
    }

    public function index(Request $request)
    {
        $this->with = ['enderecos', 'anexos'];
        $response = parent::index($request);

        // $response = Acampamento::find(36)
        //     ->with('enderecos')
        //     ->get();

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $resu = $this->repository->createAcampamento($request);

        if ($resu) {
            $message = [
                'message' => 'Local de Acampamento adicionado com sucesso!'
            ];
        } else {
            $message = [
                'error' => 'tivemos um problema ao cadastrar a area de acampamento!'
            ];
        }

        return response()->json($message);
    }

    public function view($id)
    {
        $response = $this->repository->getEntityWith($id, ['enderecos', 'anexos']);

        return response()->json($response);
    }
}
