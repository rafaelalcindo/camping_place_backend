<?php

namespace App\Repositories;

use App\Model\Anexo;

class AnexosRepository extends CrudRepository
{
    public function __construct()
    {
        $this->model = new Anexo();
    }

    public function cadastrarAnexos(array $request, int $acampamento_id)
    {
        if (isset($request['anexos']) && !empty($request['anexos'])) {
            foreach ($request['anexos'] as $idx => $anexo) {
                $anexo['arquivo'] = $this->moveUploadFileDirectly($anexo['arquivo'], 'images');
                $anexo['nome_arquivo'] = 'anexo' . $acampamento_id;
                $anexo['acampamento_id'] = $acampamento_id;
                $this->create($anexo);
            }
        }
    }
}
