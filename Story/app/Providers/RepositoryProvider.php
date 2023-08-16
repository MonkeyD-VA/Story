<?php

namespace App\Providers;
// namespace App\Repositories\Story;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Story\StoryRepository;
use App\Repositories\Story\StoryRepositoryInterface;

class RepositoryProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register()
  {
    $this->app->bind(
      StoryRepositoryInterface::class,
      StoryRepository::class
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
