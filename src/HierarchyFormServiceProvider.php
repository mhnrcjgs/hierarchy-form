<?php

namespace Dakine\HierarchyForm;

use Illuminate\Support\ServiceProvider;

class HierarchyFormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('hierarchyForm', 'SmallBiz\HierarchyForm');
    }
}
