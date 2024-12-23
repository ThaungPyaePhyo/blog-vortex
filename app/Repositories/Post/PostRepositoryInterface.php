<?php

namespace App\Repositories\Post;

use App\Api\Foundation\Repository\EloquentRepositoryInterface;

interface PostRepositoryInterface extends EloquentRepositoryInterface
{
    public function optionsQuery(array $options);
    public function connection();
}
