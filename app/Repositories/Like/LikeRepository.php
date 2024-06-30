<?php

namespace App\Repositories\Like;

use App\Models\Comment;
use App\Models\Like;
use Illuminate\Database\Eloquent\Builder;
use App\Api\Foundation\Repository\Eloquent\BaseRepository;

class LikeRepository extends BaseRepository implements LikeRepositoryInterface
{
    public function optionsQuery(array $options): Builder
    {
        return parent::optionsQuery($options);
    }

    public function connection(): Like
    {
        return new Like();
    }

    public function getDataByUserIdAndPostId($user_id, $post_id)
    {
        return $this->connection()->where('user_id', $user_id)->where('post_id', $post_id)->first();
    }
}
