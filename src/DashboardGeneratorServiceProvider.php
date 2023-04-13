<?php
namespace Mostafa0alii\DashboardGenerator;
use Illuminate\Support\ServiceProvider;

class DashboardGeneratorServiceProvider extends ServiceProvider {
    public function register() {
        //
    }

    public function boot() {
        $this->publishes([
            __DIR__.'/../resourses/views' => resource_path('views'),
        ], 'view');
        $this->publishes([
            __DIR__.'/../resourses/assets' => public_path('assets'),
        ], 'assets');
    }
}