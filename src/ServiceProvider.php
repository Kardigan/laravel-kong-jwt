<?php namespace Kardigan\LaravelKongJwt;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $router->aliasMiddleware(
            'kongjwt',
            'Brandsafe\LaravelKongJwt\KongJwtMiddleware'
        );
    }
}
