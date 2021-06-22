<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\traits\GlobalTratis;
use Tymon\JWTAuth\Http\Parser\QueryString;

// use App\Models\QueryString;

class CrudRepository
{
    use GlobalTratis;

    protected $model;
    protected $searchFields = [];

    public function findAll($params = null, $with = null, $where = null, $whereList = [])
    {
        $query = $this->model;

        if (!empty($params)) {
            $query = ($params->active) ? $query->orderBy($params->active, $params->direction) : $query;
            $query = ($params->pageIndex) ? $query->offset($params->pageIndex) : $query;
            $query = ($params->pageSize) ? $query->limit($params->pageSize) : $query;
        }
        if ($where) {
            $query = $query->where($where['column'], $where['signal'], $where['value']);
        }

        if (!empty($whereList)) {
            foreach ($whereList as $idx => $where) {
                $query = $query->where($where['column'], $where['signal'], $where['value']);
            }
        }

        if ($with) {
            $query = $query->with($with);
        }

        return $query->paginate(10);
    }

    public function create(array $data)
    {
        $entity = $this->model;
        $entity->fill($data);
        return $entity->save() ? $entity : false;
    }

    public function update(int $id, array $data)
    {
        $entity = $this->getEntity($id);
        return $entity
            ->update($data) ? $entity : false;
    }

    public function delete(int $id)
    {
        return $this->getEntity($id)
            ->delete();
    }

    public function getEntity(int $id)
    {
        return $this->model
            ->where('id', $id)
            ->firstOrFail();
    }

    public function getEntityWith(int $id, array $with = [])
    {;
        $query = $this->model;
        if (!empty($with)) {
            $query = $query->with($with);
        }

        $query = $query->where('id', $id);
        // dd($query->firstOrFail());

        return $query->firstOrFail();
    }
}
