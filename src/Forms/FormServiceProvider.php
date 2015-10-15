<?php

namespace Koenvu\Forms;

use Illuminate\Support\ServiceProvider;
use Koenvu\Forms\Console\FormMakeCommand;

class FormServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerFormGenerator();

        $this->commands('command.form.make');
    }

    protected function registerFormGenerator()
    {
        $this->app->singleton('command.form.make', function ($app) {
            return new FormMakeCommand($app['files']);
        });
    }

    public function boot()
    {
        // $this->loadViewsFrom(__DIR__ . '/../views', 'form');
    }
}
