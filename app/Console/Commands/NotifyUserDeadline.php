<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use Nexmo;
use Carbon\Carbon;
class NotifyUserDeadline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'NotifyUser:Deadline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will Notify User of Deadline';

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
    
            if($d->invert == 0 && $d->h < 24){
                $plans = DB::table('plans')
                ->Join('budgets', 'budgets.id', '=', 'plans.budget_id')
                ->Join('users', 'users.id', '=', 'budgets.user_id')
                ->Join('submissions', 'submissions.id', '=', 'budgets.submission_id')
                ->where('submissions.active', '=', 1)
                ->where('submissions.id', '=', $submission->id)
                ->select('plans.*', 'users.contact_no as contact')
                ->get();
    
                foreach ($plans as $key => $value) {
                    Nexmo::message()->send([
                        'to' => $value->contact,
                        'from' => '639359005736',
                        'text'=> 'Submit your plan 1 day remaining before the deadline of submission'
                    ]);
                }
            }
        }
    }
}
