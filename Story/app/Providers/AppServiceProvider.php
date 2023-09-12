<?php

namespace App\Providers;

use App\Repositories\Page\PageRepository;
use App\Repositories\Page\PageRepositoryInterface;
use App\Repositories\Story\StoryRepository;
use App\Repositories\Story\StoryRepositoryInterface;
use App\Repositories\Text\TextRepository;
use App\Repositories\Text\TextRepositoryInterface;
use App\Repositories\TextConfig\TextConfigRepository;
use App\Repositories\TextConfig\TextConfigRepositoryInterface;
use App\Repositories\Touch\TouchRepository;
use App\Repositories\Touch\TouchRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StoryRepositoryInterface::class, StoryRepository::class);
        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
        $this->app->bind(TextRepositoryInterface::class, TextRepository::class);
        $this->app->bind(TouchRepositoryInterface::class, TouchRepository::class);
        $this->app->bind(TextConfigRepositoryInterface::class, TextConfigRepository::class);
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
