<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Post;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function __construct(protected CommentService $service)
    {

    }
    public function store(CommentRequest $request, Post $post)
    {
        $response = $this->service->create($request,$post);

        if ($response) {
            return redirect()->route('posts.index')->with('success', 'Comment created successfully.');
        }
        return back()->with('error', 'Something went wrong.');
    }
}
