<?php

namespace App\Providers;

use App\Repositories\Story\StoryRepository;
use App\Repositories\Story\StoryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            StoryRepositoryInterface::class,
            StoryRepository::class,
        );
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
