<?php namespace MrJuliuss\Syntara;

use Illuminate\Support\ServiceProvider;

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
	
}
