<?php

namespace App\Repository\Interfaces;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interface DatabaseInterface
 * @package App\Repositories\Interfaces;
 */
interface DatabaseInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;
}
