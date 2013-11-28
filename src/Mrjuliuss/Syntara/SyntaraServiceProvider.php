<?php 

namespace MrJuliuss\Syntara;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Environment;

class SyntaraServiceProvider extends ServiceProvider
{

    /**
    * Indicates if loading of the provider is deferred.
    *
    * @var bool
    */
    protected $defer = false;

    public function boot() 
    {
        $this->package('mrjuliuss/syntara');

        // include start file
        include ( __DIR__ . '/../../start.php');
    }

    /**
    * Register the service provider.
    *
    * @return void
    */
    public function register()
    {
        //Load package config
        $this->app['config']->package('mrjuliuss/syntara', __DIR__.'/../../config');

        $this->app['config']->set('view.pagination', 'syntara::layouts.pagination.bootstrap3');
        
        // add the user seed command to the application
        $this->app['create:user'] = $this->app->share(function($app)
        {
            return new Commands\UserSeedCommand($app);
        });

        // add the install command to the application
        $this->app['syntara:install'] = $this->app->share(function($app)
        {
            return new Commands\InstallCommand($app);
        });

        // add the update command to the application
        $this->app['syntara:update'] = $this->app->share(function($app)
        {
            return new Commands\UpdateCommand($app);
        });
        
        // register helpers
        $this->registerHelpers();

        // register models
        $this->registerModels();
        
        //Add commands
        $this->commands('create:user');
        $this->commands('syntara:install');
        $this->commands('syntara:update');
    }

    /**
    * Get the services provided by the provider.
    *
    * @return array
    */
    public function provides()
    {
        return array();
    }

    /**
    * Register helpers in app
    */
    public function registerHelpers()
    {
        $this->app['breadcrumbs'] = $this->app->share(function()
        {
            return new \MrJuliuss\Syntara\Helpers\Breadcrumbs();
        });
        
        // Shortcut so developers don't need to add an Alias in app/config/app.php
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Breadcrumbs', 'MrJuliuss\Syntara\Facades\Breadcrumbs');
        });
    }

    public function registerModels()
    {
        $this->app['permissionProvider'] = $this->app->share(function()
        {
            return new \MrJuliuss\Syntara\Models\Permissions\PermissionProvider();
        });
        
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('PermissionProvider', 'MrJuliuss\Syntara\Facades\PermissionProvider');
        });
    }
    
}
