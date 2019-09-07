<?php

namespace Joyching\I18n;

use Illuminate\Support\ServiceProvider;
use Joyching\I18n\Console\Commands\ExportCommand;

class I18nServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ExportCommand::class,
            ]);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->offerPublishing();
    }

    /**
     * Setup the resource publishing groups for Passport.
     *
     * @return void
     */
    protected function offerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/i18ntool.php' => config_path('i18ntool.php'),
            ], 'i18ntool-config');
        }
    }
}
