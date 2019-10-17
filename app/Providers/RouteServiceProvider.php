<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $backendNamespace;
    protected $browserNamespace;
    protected $clientNamespace;
    protected $currentDomain; 

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //
        $v = request()->v; 
        $v = empty($v) ? 'V1' : "V{$v}";
        request()->v = strtolower($v);
        $this->backendNamespace = 'App\Http\Controllers\Backend';
        $this->browserNamespace = 'App\Http\Controllers\Browser';
        $this->clientNamespace = "App\Http\Controllers\Client\\{$v}";

        $this->currentDomain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : "";

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(Router $router)
    {
//         $this->mapApiRoutes();

//         $this->mapWebRoutes();
        $backendUrl = config('route.backend_url');
        $browserUrl = config('route.browser_url');
        $clientUrl = config('route.client_url');
        switch ($this->currentDomain) {
            case $clientUrl:
                // client路由
                $router->group([
                'domain' => $clientUrl,
                'namespace' => $this->clientNamespace],
                function ($router) {
                    require base_path('routes/client.php');
                }
                );
                
                break;
            case $backendUrl:
                // 后端路由
                $router->group([
                'domain' => $backendUrl,
                'namespace' => $this->backendNamespace],
                function ($router) {
                    require base_path('routes/backend.php');
                }
                );
                break;
            default:
                // 前端路由
                $router->group([
                'middleware'=>['web'],
                'domain' => $browserUrl,
                'namespace' => $this->browserNamespace],
                function ($router) {
                    require base_path('routes/browser.php');
                }
                );
                
                break;
        }

        //
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
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
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
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
