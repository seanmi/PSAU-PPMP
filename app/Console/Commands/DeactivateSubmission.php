<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;

use Carbon\Carbon;

class DeactivateSubmission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deactivate:submission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate submission when it reaches the deadline';

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
        $submission = DB::table('submissions')
                     ->where('submissions.active', 1)
                     ->first();
        if($submission){
            $end = new Carbon($submission->deadline_submission);
            $now = Carbon::now();
            $d = $now->diff($end);
    
            if($d->invert == 1){
                $submission = DB::table('submissions')
                ->where('active','=', 1)
                ->update(['active'=> NULL]);
            }
        }
    }
}
