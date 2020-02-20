<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\ItemRepositoryInterface;
use App\Models\Item;

class ItemRepository implements ItemRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = app()->make(Item::class);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    //findById
    public function findById($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function findOrFail($id)
    {
        $result = $this->model->findOrFail($id);

        return $result;
    }

    public function find($data = [])
    {
        $result = $this->model->where($data)->get();

        return $result;
    }

    public function findFirst($data = [])
    {
        $result = $this->model->where($data)->first();

        return $result;
    }

    public function create($data = [])
    {
        return $this->model->create($data);
    }

    public function update($obj, $data = [])
    {
        if ($obj) {
            $obj->update($data);

            return $obj;
        }

        return false;
    }

    public function destroy($id)
    {
        $result = $this->findById($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}