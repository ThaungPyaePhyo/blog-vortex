<?php

namespace App\Services;

use App\Repositories\Like\LikeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class LikeService
{
    use Helper;

    public function __construct(protected LikeRepositoryInterface $repository)
    {
    }

    public function create($post)
    {
        $input['user_id'] = $this->getUser()->id;
        $input['post_id'] = $post->id;
        DB::beginTransaction();
        try {
            $like = $this->repository->insert($input);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorLogger($e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
        return true;
    }

    public function delete($post)
    {
        $user_id = $this->getUser()->id;
        $post_id = $post->id;
        $like = $this->repository->getDataByUserIdAndPostId($user_id, $post_id);
        DB::beginTransaction();
        try {
            if ($like) {
                $like->delete();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorLogger($e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
        return true;
    }

}
