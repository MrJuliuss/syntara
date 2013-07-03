<?php 

namespace MrJuliuss\Syntara\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class UserSeedCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'create:user';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create new user in database';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
        try 
        {
            // Create the user
            $user = \Sentry::getUserProvider()->create(array(
                'email'    => $this->argument('email'),
                'password' => $this->argument('password'),
            ));

            $activationCode = $user->getActivationCode();
            $user->attemptActivation($activationCode);
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e){}
	}

    /**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('email',    InputArgument::REQUIRED, 'User email'),
			array('password', InputArgument::REQUIRED, 'User password')
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array();
	}

}