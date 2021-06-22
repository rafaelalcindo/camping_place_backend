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
}
