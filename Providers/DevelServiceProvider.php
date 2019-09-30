<?php

namespace Pingu\Devel\Providers;

use Illuminate\Database\Eloquent\Factory;
use Pingu\Core\Support\ModuleServiceProvider;

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
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'devel');
        $this->registerFactories();
        // $this->registerAssets();
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
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
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
