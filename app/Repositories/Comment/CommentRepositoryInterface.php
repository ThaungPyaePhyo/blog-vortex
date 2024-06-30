<?php

namespace App\Repositories\Comment;

use App\Api\Foundation\Repository\EloquentRepositoryInterface;

interface CommentRepositoryInterface extends EloquentRepositoryInterface
{
    public function optionsQuery(array $options);
    public function connection();
}
