<?php

namespace Sbit\WebInstaller\Providers;

use Illuminate\Support\ServiceProvider;

class WebInstallerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishFiles();
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $installedLogFile = storage_path('installed');

        if (!file_exists($installedLogFile)) {
            return redirect('/install');
        }
    }

    /**
     * Publish config file for the installer.
     *
     * @return void
     */
    protected function publishFiles()
    {
        $this->publishes([
            __DIR__.'/../assets' => public_path('installerfiles'),
        ]);
        $this->publishes([
            __DIR__.'/../Views' => base_path('resources/views/web/installer'),
        ]);
    }
}