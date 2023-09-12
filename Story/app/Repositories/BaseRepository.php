<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

abstract class BaseRepository implements RepositoryInterface
{
    //model muốn tương tác
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    public function getDataRequest(Request $request) {
        $result = [];
        $data = $request->all();
        foreach($data as $key => $value) {
            if (Schema::hasColumn($this->model->getTable(), $key)) {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    //lấy model tương ứng
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function show($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function store($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->show($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function destroy($id)
    {
        $result = $this->show($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}
