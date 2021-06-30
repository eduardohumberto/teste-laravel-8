<?php

namespace App\Providers;

use App\Repository\Implementations\Eloquent\BaseRepository;
use App\Repository\Implementations\Eloquent\PostRepository;
use App\Repository\Interfaces\DatabaseInterface;
use App\Repository\Interfaces\PostRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DatabaseInterface::class, BaseRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
