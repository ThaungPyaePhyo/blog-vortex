<?php

namespace App\Services;

use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostService
{
    use Helper;
    public function __construct(protected PostRepositoryInterface $repository)
    {
    }
    public function create(Request $request): bool
    {
        $input = $request->except('_token');
        DB::beginTransaction();
        try {
            $input['slug'] = Str::slug($request->title);
            $input['user_id'] = Auth::id();
            $input['image'] = $request->file('image')->store('uploads/posts', 'public');
            $post = $this->repository->insert($input);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorLogger($e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
        return true;
    }

    public function getUser()
    {
        return auth()->user();
    }

    public function getQuery()
    {
        return $this->repository->optionsQuery([]);
    }

    public function getDataById($id)
    {
        return $this->repository->getDataById($id);
    }

    public function update(Request $request, $post)
    {
        $input = $request->except('_token', '_method');

        DB::beginTransaction();

        try {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('uploads/posts', 'public');
                $input['image'] = $imagePath;
            }
            $this->repository->update($input, $post->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorLogger($e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        }
        return true;
    }

    public function deletePost($id): bool
    {
        DB::beginTransaction();
        try {
            $post = $this->repository->getDataById($id);

            if ($post->image) {
                $imagePath = 'uploads/posts/' . $post->image;
                Storage::disk('public')->delete($imagePath);
            }

            $this->repository->destroy($id);

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            $this->errorLogger($exception->getMessage(), $exception->getFile(), $exception->getLine());
            return false;
        }
        return true;
    }
}
