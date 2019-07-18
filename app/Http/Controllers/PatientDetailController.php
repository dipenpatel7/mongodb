<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Patient;
use App\PatientDetail;
use App\Insurance;
use App\PatientInsurance;

class PatientDetailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $query = PatientDetail::get()->toArray();
        echo '<pre>'; print_r($query); die;
        return view('home');
    }
   
}
