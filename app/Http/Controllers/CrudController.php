<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrudController extends Controller
{
    protected $repository;
    protected $with = null;
    protected $where = null;
    protected $whereList = [];

    protected function getQueryParams(Request $request)
    {
        $query = [];
        $query = $request->only(
            ['search', 'direction', 'active', 'pageIndex', 'pageSize']
        );

        return $query;
    }

    public function index(Request $request)
    {
        $params = $this->getQueryParams($request);
        $itens = $this->repository->findAll($params, $this->with, $this->where, $this->whereList);
        return $itens;
    }
}
