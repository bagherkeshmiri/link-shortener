<?php

namespace App\Repositories;

interface RepositoryInterface
{

    public function getModel();

    public function all(array $columns = null);

    public function paginate(array $columns = null);

    public function createMany(array $records);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);

    public function filters($val);

}
