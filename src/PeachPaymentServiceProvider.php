<?php

namespace IoDigital\PeachPayment;

use Illuminate\Support\ServiceProvider;

class PeachPaymentServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/peachpayment.php' => config_path('peachpayment.php'),
            ], 'peachpayment-config');

            $this->publishes([
                __DIR__.'/../database/migrations/create_payment_cards_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_payment_cards_table.php'),
                __DIR__.'/../database/migrations/create_payment_results_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_payment_results_table.php'),
                __DIR__.'/../database/migrations/create_payment_events_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_payment_events_table.php'),
            ], 'peachpayment-migrations');
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/peachpayment.php', 'peachpayment');

        // Register the service the package provides.
        $this->app->singleton('peachpayment', function ($app) {
            return new PeachPayment;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['peachpayment'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/peachpayment.php' => config_path('peachpayment.php'),
        ], 'peachpayment.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/iodigital'),
        ], 'peachpayment.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/iodigital'),
        ], 'peachpayment.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/iodigital'),
        ], 'peachpayment.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
