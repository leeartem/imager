<?php

namespace App\Providers;

use App\Domain\Entities\Image\IImageRepository;
use App\Domain\Repositories\Image\ImageRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(IImageRepository::class, ImageRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    public function provides(): array
    {
        return [
            IImageRepository::class
        ];
    }
}
