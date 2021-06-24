<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EnderecosRepository;

class EnderecosController extends Controller
{
    public function __construct()
    {
        $this->enderecos = new EnderecosRepository();
    }

    public function enderecoFiltroEstado()
    {
        $enderecos = $this->enderecos->getEstados();

        return response()->json($enderecos);
    }

    public function enderecoFiltroMunicipio($estado)
    {
    }
}
