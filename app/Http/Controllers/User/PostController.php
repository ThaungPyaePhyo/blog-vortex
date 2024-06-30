<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct(protected PostService $service){

    }

    public function create()
    {
        return view('user.posts.create');
    }
    public function index()
    {
        $posts = $this->service->getQuery()->paginate(9);
        $user = $this->service->getUser();
        return view('user.posts.index',compact('posts','user'));
    }

    public function store(PostRequest $request)
    {
        $response = $this->service->create($request);

        if ($response) {
            return redirect()->route('posts.index')->with('success', 'Post created successfully.');
        }
        return back()->with('error', 'Something went wrong.');
    }

    public function show(Post $post)
    {
        return view('user.posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = $this->service->getDataById($id);
       return view('user.posts.edit',compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $response = $this->service->update($request, $post);

        if ($response) {
            return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
        }
        return back()->with('error', 'Failed to update post.');
    }

    public function destroy($id)
    {
        $post = $this->service->getDataById($id);

        $response = $this->service->deletePost($post->id);

        if (!$response) {
            return redirect()->back()->withInput()
                ->with('fail', 'Fail to delete Post.');
        }

        return redirect()->route('posts.index')
            ->with('success', 'Successful to delete Post.');
    }
}
