<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;
    /**
     * BaseRepository constructor
     * @param Model $model
     */

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function paginate($items = null, $sortColumn = 'id', $sortOrder = 'asc', $filterField = 'name', $filter = null)
    {
        $model = $this->model->orderBy($sortColumn, $sortOrder);

        if ($filter) {
            $model->where($filterField, 'like', '%'. $filter.'%');
        }

        return $model->paginate($items);
    }

    /**
    * Get Resource by Id
    *
    * @param int $id
    * @param boolean $withTrashed
    * @return void
    */

    public function getById(int $id, bool $withTrashed = false)
    {
        return $this->model->when($withTrashed, function ($query) {
            return $query->withTrashed();
        })->findOrFail($id);
    }

    public function create(array $attributes)
    {
        try {
            return $this->model->create($attributes);
        } catch(\Exception $e) {
            return $e->getMessage();
        }

    }

    public function update(array $attributes, $id)
    {

        $model = $this->getById($id);

        $model->update($attributes);

        return $model;

    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function restore($id)
    {
        return $this->model->withTrashed()->findOrFail($id)->restore();
    }

}
