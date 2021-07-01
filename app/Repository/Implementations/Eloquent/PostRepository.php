<?php

namespace App\Repository\Implementations\Eloquent;

use App\Models\Post;
use App\Repository\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Collection;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{

    /**
     * PostRepository constructor.
     *
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    public function paginate($params = [])
    {
        return $this->model::orderBy('created_at', 'desc')->paginate($params);
    }

    public function search($params = [])
    {
        return $this->model::where('title', 'LIKE', "%{$params['search']}%")
            ->orWhere('content', 'LIKE', "%{$params['search']}%")
            ->paginate($params['page'] ?? 15);
    }
}
