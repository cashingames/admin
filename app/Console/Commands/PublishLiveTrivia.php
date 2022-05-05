<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Live\Trivia;
use Carbon\Carbon;

class PublishLiveTrivia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trivia:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish a live trivia';

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
       Trivia::where('start_time','>=', Carbon::today('Africa/Lagos')->startOfDay())
       ->where('end_time','<=', Carbon::today('Africa/Lagos')->endOfDay())
       ->update(['is_published'=>true]);
    
    }
}
