<?php
namespace App\Repositories;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class AbstractRepository {
    protected static $model;

    public function loadModel() {
        return App(static::$model);
    } 

    public function all() : Collection {
        return $this->loadModel()::query()->all();
    }

    public function findId(int $id) : Model | null {
        return $this->loadModel()::query()->find($id);
    }
    
    public function basicPaginate(int $amount, string $path = '') : LengthAwarePaginator {
        $result = $this->loadModel()::query()->paginate($amount);
        $result->setPath($path);
        return $result;
    }

    public function create(array $data = []) : Model | null{
        return $this->loadModel()::query()->create($data);
    }

    public function delete(int $id) : int{
        return $this->loadModel()::query()->where("id", $id)->delete();
    }
    
    public function update(array $data = [], int $id) : Model {
        $this->loadModel()::query()->where("id", $id)->update($data);
        return $this->loadModel()::query()->find($id);
    }
}