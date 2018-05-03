<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class tablesDrop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tables:drop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'drop all tables';

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
     * @return mixed
     */
    public function handle()
    {
        $this->tablesDrop();
    }

    public function tablesDrop()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('screens');
        Schema::dropIfExists('seats');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('migrations');
        $this->info('drop users,screens,seats,tickets,migrations successfully');
    }

}
