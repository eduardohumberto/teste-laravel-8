<?php

namespace App\Repository\Interfaces;

use Illuminate\Support\Collection;

interface PostRepositoryInterface
{
    public function all(): Collection;
}
