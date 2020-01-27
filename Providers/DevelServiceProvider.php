<?php

namespace Pingu\Devel\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Routing\Router;
use Pingu\Core\Support\ModuleServiceProvider;
use Pingu\Devel\Collectors\FormCollector;
use Pingu\Devel\Cron;
use Pingu\Devel\Http\Middlewares\ActivateDebugBar;
use Pingu\Devel\Http\Middlewares\CheckForMaintenanceMode;

class DevelServiceProvider extends ModuleServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $router->pushMiddlewareToGroup('web', ActivateDebugBar::class);
        $router->pushMiddlewareToGroup('web', CheckForMaintenanceMode::class);
        $router->pushMiddlewareToGroup('ajax', CheckForMaintenanceMode::class);
        $this->registerTranslations();
        $this->registerConfig();
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'devel');
        $this->registerFactories();
        \Asset::container('modules')->add('devel-js', 'module-assets/Devel.js');
    }

    /**
     * Register js and css for this module
     */
    public function registerAssets()
    {
        \Asset::container('modules')->add('devel-js', 'module-assets/Devel.js');
        \Asset::container('modules')->add('devel-css', 'module-assets/Devel.css');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'devel.cron', function ($app) {
                return new Cron($app->make(Schedule::class));
            }
        );
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $formCollector = new FormCollector;
        $this->app->singleton(
            'devel.formCollector', function () use ($formCollector) {
                return $formCollector;
            }
        );
        // \DebugBar::addCollector($formCollector);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'devel'
        );
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/devel');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'devel');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'devel');
        }
    }

    /**
     * Register an additional directory of factories.
     * 
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
