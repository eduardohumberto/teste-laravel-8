<?php

namespace App\Repository\Implementations\Eloquent;

use App\Repository\Interfaces\DatabaseInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements DatabaseInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function update(string $id, array $attributes): bool
    {
        return $this->model->find($id)->update($attributes);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @param $model
     * @return true
     */
    public function delete($model): ?bool
    {
        return $model->delete();
    }

    public function paginate($params = [])
    {
        return $this->model::paginate($params);
    }
}
