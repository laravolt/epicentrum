<?php

namespace Laravolt\Epicentrum;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class PackageServiceProvider
 *
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Laravolt\Epicentrum\Repositories\RepositoryInterface::class,
            \Laravolt\Epicentrum\Repositories\EloquentRepository::class);
    }

    /**
     * Application is booting
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'epicentrum'
        );

        $this->loadViewsFrom(realpath(__DIR__.'/../resources/views'), 'epicentrum');

        $this->loadTranslationsFrom(realpath(__DIR__.'/../resources/lang'), 'epicentrum');

        $this->loadMigrationsFrom(realpath(__DIR__.'/../database/migrations'));

        if (config('epicentrum.route.enable')) {
            $this->loadRoutes();
        }

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('SemanticForm', \Laravolt\SemanticForm\Facade::class);
        $loader->alias('Suitable', \Laravolt\Suitable\Facade::class);
    }

    protected function loadRoutes()
    {
        $router = $this->app['router'];
        require __DIR__.'/Http/routes.php';
    }
}
