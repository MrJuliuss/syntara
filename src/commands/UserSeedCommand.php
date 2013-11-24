<?php 

namespace MrJuliuss\Syntara\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Config;
use MrJuliuss\Syntara\Services\Validators\User as UserValidator;

class UserSeedCommand extends Command 
{

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
            $groupName = $this->argument('group');

            $validator = new UserValidator(array(
                    'email'    => $email,
                    'pass' => $pass,
                    'username' => $username,
                ),
            'create');

            if(!$validator->passes())
            {
                foreach($validator->getErrors() as $key => $messages)
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

                if($groupName !== NULL)
                {
                    $group = \Sentry::getGroupProvider()->findByName($groupName);

                    $user->addGroup($group);
                }

                $this->info('User created with success');
            }
        }
        catch (\Cartalyst\Sentry\Users\UserExistsException $e)
        {
            $this->error('User already exists !');
        }
        catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            $this->error('Group '.$groupName.' does not exists !');
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
            array('username', InputArgument::REQUIRED, 'User name'),
            array('email',    InputArgument::REQUIRED, 'User email'),
            array('password', InputArgument::REQUIRED, 'User password'),
            array('group', InputArgument::OPTIONAL, 'Group')
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