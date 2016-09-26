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

    protected $requiredProviders = [
        \Laravolt\Suitable\ServiceProvider::class,
        \Laravolt\SemanticForm\ServiceProvider::class,
        \Laravolt\Password\ServiceProvider::class,
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Laravolt\Epicentrum\Repositories\RepositoryInterface::class,
            \Laravolt\Epicentrum\Repositories\EloquentRepository::class);

        $this->app->bind(\Laravolt\Epicentrum\Repositories\TimezoneRepository::class,
            \Laravolt\Epicentrum\Repositories\DefaultTimezoneRepository::class);
    }

    /**
     * Application is booting
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'laravolt.epicentrum'
        );

        $this->loadViewsFrom(realpath(__DIR__.'/../resources/views'), 'epicentrum');

        $this->loadTranslationsFrom(realpath(__DIR__.'/../resources/lang'), 'epicentrum');

        $this->loadMigrationsFrom(realpath(__DIR__.'/../database/migrations'));

        if (config('laravolt.epicentrum.route.enable')) {
            $this->loadRoutes();
        }

        $this->loadRequiredProviders();

        $this->registerMenu();

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('SemanticForm', \Laravolt\SemanticForm\Facade::class);
        $loader->alias('Suitable', \Laravolt\Suitable\Facade::class);
    }

    protected function loadRequiredProviders()
    {
        $loadedProviders = $this->app->getLoadedProviders();

        foreach ($this->requiredProviders as $class) {
            if (!isset($loadedProviders[$class])) {
                $this->app->register($class);
            }
        }
    }

    protected function loadRoutes()
    {
        $router = $this->app['router'];
        require __DIR__.'/Http/routes.php';
    }

    protected function registerMenu()
    {
        if ($this->app->bound('laravolt.menu')) {
            $menu = $this->app['laravolt.menu']->add('Epicentrum')->data('icon', 'users');
            $menu->add(trans('epicentrum::label.users'), route('epicentrum::users.index'));
            $menu->add(trans('epicentrum::label.roles'), route('epicentrum::roles.index'));
        }
    }
}
