<?php

namespace App\Console\Commands\Product;

use Illuminate\Console\Command;
use App\Traits\CommandTrait;

class ImportProducts extends Command
{
    use CommandTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:import-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from json file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $scriptTimeStart =  $this->displayCommandStart('Importing products has started...');

        $this->truncateTables(['products'], true);
       
       
        $this->displayExecutionTime($scriptTimeStart);
    }
}
