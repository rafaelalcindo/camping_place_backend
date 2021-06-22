<?php

namespace App\Repositories;

use App\Model\Acampamento;
use App\Repositories\EnderecosRepository;
use App\Repositories\AnexosRepository;

class AcampamentosRepository extends CrudRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Acampamento();
        $this->endereco = new EnderecosRepository();
        $this->anexo = new AnexosRepository();
    }

    public function createAcampamento($request)
    {
        $request['foto_principal'] = $this->moveUpload($request, 'foto_principal_upload', 'images');

        // dd($request);

        $acampamento = $this->create($request->all());

        if ($acampamento) {
            $request['acampamento_id'] = $acampamento->id;
            $this->endereco->addEndereco($request->all());
            $this->anexo->cadastrarAnexos($request->all(), $acampamento->id);
        }

        return $acampamento;
    }
}
