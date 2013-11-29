<?php

namespace MrJuliuss\Syntara\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Sentry;

class UpdateCommand extends Command 
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'syntara:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syntara update command';

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
        $this->info('## Syntara Update ##');

        // publish syntara assets
        $this->call('asset:publish', array('package' => 'mrjuliuss/syntara' ) );

        // run migrations
        $this->call('migrate', array('--env' => $this->option('env'), '--package' => 'cartalyst/sentry' ) );
        $this->call('migrate', array('--env' => $this->option('env'), '--package' => 'mrjuliuss/syntara' ) );
    }
}
