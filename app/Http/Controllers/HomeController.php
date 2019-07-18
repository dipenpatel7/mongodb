<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserDetail;
use DB;

class HomeController extends Controller
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
        
        return view('home');
    }
    public function mongoConnect()
    {
//        $query = new UserDetail();
//        $query->name = 'asfak dsds 11';
//        $query->surname = 'malek dsds';
//        $query->birth_year = '1992';
//        $query->email = 'a1113@gmail.com';
//        $query->save();
//        echo '<pre>'; print_r($query->_id); 
        $data = UserDetail::select('*')->where('birth_year','1992')->get()->toArray();
        echo '<pre>'; print_r($data);
        $x = UserDetail::find('5d2da097a15b0000420012ef')->toArray();
        echo '<pre>'; print_r($x); 
        
        
        die;
        return view('home');
    }
    
    public function phpinfo(){
        echo phpinfo(); die;
    }
}
