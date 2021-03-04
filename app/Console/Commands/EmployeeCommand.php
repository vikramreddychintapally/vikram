<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesCommands;
use App\Jobs\EmployeeJob;
class EmployeeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'empInsert:empInsert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description for Insert EMployee';

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
        $this->dispatch(EmployeeJob::class);
    }
}
