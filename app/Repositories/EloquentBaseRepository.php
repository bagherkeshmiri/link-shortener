<?php

namespace App\Repositories;

class EloquentBaseRepository implements RepositoryInterface, \Countable
{

    protected string $model;

    public function getModel()
    {
        return resolve($this->model);
    }

    public function count(): int
    {
        return $this->model::count();
    }

    public function all(array $columns = null)
    {
        if (!is_null($columns))
            return $this->model::select($columns)->get();
        return $this->model::get();
    }

    public function paginate(array $columns = null)
    {
        if (!is_null($columns))
            return $this->model::select($columns)->paginate();
        return $this->model::orderBy('created_at','desc')->paginate();
    }

    public function createMany(array $records)
    {
        return $this->model::insert($records);
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function update(array $data, $id)
    {
        return $this->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model::destroy($id);
    }


    public function find($id)
    {
        return $this->model::find($id);
    }


    public function filters($val): static
    {
         $this->model::filters($val);
        return $this;
    }

}
