<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;
use App\Api\Foundation\Repository\Eloquent\BaseRepository;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function optionsQuery(array $options): Builder
    {
        return parent::optionsQuery($options);
    }

    public function connection(): Comment
    {
        return new Comment();
    }
}
