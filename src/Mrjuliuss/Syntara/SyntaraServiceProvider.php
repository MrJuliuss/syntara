<?php namespace MrJuliuss\Syntara;

use Illuminate\Support\ServiceProvider;
use Config;

class SyntaraServiceProvider extends ServiceProvider {

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
		// add the user seed command to the application
		$this->app['create:user'] = $this->app->share(function($app)
		{
			return new Commands\UserSeedCommand($app);
		});
        
        // register helpers
		$this->registerHelpers();
        
		//Add commands
		$this->commands('create:user');
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
    
}
