<?php

namespace App\Providers;

use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Like\LikeRepository;
use App\Repositories\Like\LikeRepositoryInterface;
use App\Repositories\Post\PostRepository;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->app->singleton(PostRepositoryInterface::class, PostRepository::class);
        $this->app->singleton(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->singleton(LikeRepositoryInterface::class, LikeRepository::class);
    }
}
