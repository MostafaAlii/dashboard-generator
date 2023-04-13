<?php
namespace Mostafa0alii\DashboardGenerator;
use Illuminate\Support\ServiceProvider;

class DashboardGeneratorServiceProvider extends ServiceProvider {
    public function register() {
        //
    }

    public function boot() {
        if ($this->app->runningInConsole()) {
            $this->commands([
                DashboardInstall::class,
            ]);
        }
        $this->publishableGroups([
            'views' => [
                __DIR__.'/../resources/views/layouts' => resource_path('views/dashboard'),
            ],
            'public' => [
                __DIR__.'/../resources/assets' => public_path('assets'),
            ],
        ]);
    }
}