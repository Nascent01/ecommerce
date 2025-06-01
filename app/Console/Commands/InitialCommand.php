<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\CommandTrait;
use Illuminate\Support\Facades\Artisan;

class InitialCommand extends Command
{
    use CommandTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:initial-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initial command to run all necessary tasks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $scriptTimeStart =  $this->displayCommandStart('Initial command has started...');

        Artisan::call('migrate:fresh', ['--force' => true]);
        $this->line(Artisan::output());

        Artisan::call('db:seed');
        $this->line(Artisan::output());

        Artisan::call('command:import-products');
        $this->line(Artisan::output());

        Artisan::call('command:synchronize-permissions');
        $this->line(Artisan::output());

        if (!file_exists(public_path('storage'))) {
            Artisan::call('storage:link');
            $this->line(Artisan::output());
        }

        $this->displayExecutionTime($scriptTimeStart);
    }
}
