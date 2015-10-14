<?php

namespace Koenvu\Forms;

use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    public function register()
    {
        // ...
    }

    public function boot()
    {
        // $this->loadViewsFrom(__DIR__ . '/../views', 'form');
    }
}
