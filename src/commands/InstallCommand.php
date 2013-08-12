<?php

namespace MrJuliuss\Syntara\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'syntara:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syntara install command';

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
        // run migrations
        $this->call('migrate', array('--env' => $this->option('env'), '--package' => 'cartalyst/sentry' ) );
        $this->call('migrate', array('--env' => $this->option('env'), '--package' => 'mrjuliuss/syntara' ) );

        // publish sentry config 
        $this->call('config:publish', array('package' => 'cartalyst/sentry' ) );

        // publish syntara config
        $this->call('config:publish', array('package' => 'mrjuliuss/syntara' ) );

        // publish syntara assets
        $this->call('asset:publish', array('package' => 'mrjuliuss/syntara' ) );
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('example', InputArgument::REQUIRED, 'An example argument.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }

}