<?php namespace MrJuliuss\Syntara\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Config;
use Validator;

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
            $email = $this->argument('email');
            $pass = $this->argument('password');
            $username = $this->argument('username');

             $validator = Validator::make(
                array(
                    'email' => $email, 
                    'pass' => $pass,
                    'username' => $username),
                Config::get('syntara::rules.users.create')
            );

            if($validator->fails())
            {
                foreach($validator->messages()->getMessages() as $key => $messages)
                {
                    $this->info(ucfirst($key).' :');
                    foreach($messages as $message)
                    {
                        $this->error($message);
                    }
                }
            }
            else
            {
                // Create the user
                $user = \Sentry::getUserProvider()->create(array(
                    'email'    => $email,
                    'password' => $pass,
                    'username' => $username,
                ));

                $activationCode = $user->getActivationCode();
                $user->attemptActivation($activationCode);

                $this->info('User created with success');
            }
        }
        catch (\Cartalyst\Sentry\Users\UserExistsException $e)
        {
            $this->error('User already exists !');
        }
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
            array('password', InputArgument::REQUIRED, 'User password'),
            array('username', InputArgument::REQUIRED, 'User name')
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