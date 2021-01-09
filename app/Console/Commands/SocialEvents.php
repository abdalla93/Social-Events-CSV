<?php

namespace App\Console\Commands;
use App\Helpers\NewYearSocailEvents;
use Illuminate\Console\Command;

class SocialEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SocailEvents:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Sicial event files';

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
     * @return int
     */
    public function handle()
    {
        try {
            $GenerateCSV = new NewYearSocailEvents();
            $GenerateCSV->makeSocailEvents();
            echo "\033[32m Socail events CSV file created successfully to CSV_files folder. \n";

        } catch (\Throwable $th) {
            echo "\033[31m something went wrong !!";
        }
    }
}
