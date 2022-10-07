<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('auth')
            ->middleware('api')
            ->namespace($this->namespace.'\Auth')
            ->group(base_path('routes/auth/index.php'));

        Route::prefix('areas')
            ->middleware('api', 'auth')
            ->namespace($this->namespace.'\Areas')
            ->group(base_path('routes/areas/index.php'));

        Route::prefix('goals')
            ->middleware('api', 'auth')
            ->namespace($this->namespace.'\Goals')
            ->group(base_path('routes/goals/index.php'));

        Route::prefix('gratitude-diaries')
            ->middleware('api', 'auth')
            ->namespace($this->namespace.'\GratitudeDiaries')
            ->group(base_path('routes/gratitude_diaries/index.php'));

        Route::prefix('notes')
            ->middleware('api', 'auth')
            ->namespace($this->namespace.'\Notes')
            ->group(base_path('routes/notes/index.php'));

        Route::prefix('streaks')
            ->middleware('api', 'auth')
            ->namespace($this->namespace.'\Streaks')
            ->group(base_path('routes/streaks/index.php'));

        Route::prefix('tasks')
            ->middleware('api', 'auth')
            ->namespace($this->namespace.'\Tasks')
            ->group(base_path('routes/tasks/index.php'));

        Route::middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/index.php'));
    }
}
