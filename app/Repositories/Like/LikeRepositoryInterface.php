<?php

namespace App\Repositories\Like;

use App\Api\Foundation\Repository\EloquentRepositoryInterface;

interface LikeRepositoryInterface extends EloquentRepositoryInterface
{
    public function optionsQuery(array $options);
    public function connection();
    public function getDataByUserIdAndPostId($user_id, $post_id);
}
