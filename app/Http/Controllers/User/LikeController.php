<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        $like = Like::firstOrCreate(
            ['user_id' => Auth::id(), 'post_id' => $post->id]
        );

        return back();
    }

    public function destroy(Post $post)
    {
        $like = Like::where('user_id', Auth::id())->where('post_id', $post->id)->first();

        if ($like) {
            $like->delete();
        }

        return back();
    }
}
