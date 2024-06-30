<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use App\Services\LikeService;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct(protected LikeService $service)
    {
    }
    public function store(Post $post)
    {
        $like = $this->service->create($post);
        return back();
    }

    public function destroy(Post $post)
    {
        $like = $this->service->delete($post);
        return back();
    }
}
