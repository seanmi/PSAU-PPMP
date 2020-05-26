<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Submission;

class ProcurementSubmissionsController extends Controller
{
    public function index(){
        return view('procurement.submission.index')->with('submissions', Submission::where('active', 1)->get());
    }
}
