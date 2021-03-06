<?php

/**
 * Laravel-SirTrevorJs.
 *
 * @link https://github.com/caouecs/Laravel-SirTrevorJs
 */

namespace Caouecs\Sirtrevorjs;

use Illuminate\Support\ServiceProvider;
use ParsedownExtraParser;

/**
 * Sir Trevor Js service provider.
 */
class SirtrevorjsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../views', 'sirtrevorjs');

        $this->publishes([
            __DIR__.'/../../config/sir-trevor-js.php' => config_path('sir-trevor-js.php'),
        ]);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind('caouecs.sirtrevorjs.converter', function () {
            return new SirTrevorJsConverter(
                new ParsedownExtraParser(),
                config('sir-trevor-js'),
                'html'
            );
        });
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
