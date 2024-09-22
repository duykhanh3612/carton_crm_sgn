<?php

namespace Modules\Api\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    // protected $moduleNamespace = 'Modules\Api\Http\Controllers';
    protected $moduleNamespace = '';
    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->SwitchDatabase();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Api', '/Routes/web.php'));
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
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Api', '/Routes/api.php'));
    }
    function SwitchDatabase()
    {
        $group = str_replace(["public/public/","www.",":81"], ["","",""], @$_SERVER['HTTP_HOST']);
        if (file_exists(base_path('public/storage/' . @$group . "/.env"))) {
            $env = parse_ini_file(base_path('public/storage/' . @$group . "/.env"), true, true);
            if (!empty($env)) {
                \Config::set('database.default', $env["DB_CONNECTION"]);
                \Config::set('database.connections.' . $env["DB_CONNECTION"] . '.host', $env["DB_HOST"]);
                \Config::set('database.connections.' . $env["DB_CONNECTION"] . '.port', $env["DB_PORT"]);
                \Config::set('database.connections.' . $env["DB_CONNECTION"] . '.database', $env["DB_CONNECTION"] == "sqlite" ? base_path($env["DB_DATABASE"]) : $env["DB_DATABASE"]);
                \Config::set('database.connections.' . $env["DB_CONNECTION"] . '.username', $env["DB_USERNAME"]);
                \Config::set('database.connections.' . $env["DB_CONNECTION"] . '.password', $env["DB_PASSWORD"]);
                \DB::purge($env["DB_CONNECTION"]);
                \DB::reconnect($env["DB_CONNECTION"]);
            }
        }
    }
}
