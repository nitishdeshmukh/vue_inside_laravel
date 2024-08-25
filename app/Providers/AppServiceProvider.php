<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


use App\Repositories\NoteRepository;
use App\Repositories\PostRepository;
use App\Contracts\NoteServiceInterface;
use App\Contracts\PostServiseInterface;
use App\Services\NoteService;
use App\Services\PostService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NoteServiceInterface::class, NoteService::class);
        $this->app->bind(PostServiseInterface::class,PostService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
