<?php

namespace App\Repositories;

use App\Model\Endereco;

class EnderecosRepository extends CrudRepository
{
    public function __construct()
    {
        $this->model = new Endereco();
    }

    public function addEndereco(array $request)
    {
        return $this->create($request);
    }

    // Itens para pesquisa
    public function getEstados()
    {
        return $this->model
            ->select('estado')
            ->distinct('estado')
            ->get();
    }

    public function getMunicipio($estado)
    {
    }
}
