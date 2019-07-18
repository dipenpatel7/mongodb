<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserDetail;
use DB;
use App\Patient;
use App\PatientDetail;
use App\Insurance;
use App\PatientInsurance;
use App\Doc1;
use App\Doc2;
use App\Doc3;
use MongoDB\BSON\ObjectID;

class PatientController extends Controller
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
    public function index() {
//[
//                                    '$match' => ["_id" => new ObjectID("5d2eec7dc0070000b0007b00")]
//                                ], 
//        $data->first(); 
        $data = Doc1::raw((function($collection) {
                    return $collection->aggregate([
                                    [
                                    '$lookup' => [
                                        'from' => 'doc2',
                                        'localField' => '_id',
                                        'foreignField' => 'userId',
                                        'as' => 'details'
                                    ]
                                ], [
                                    '$lookup' => [
                                        'from' => 'doc3',
                                        'localField' => '_id',
                                        'foreignField' => 'userId',
                                        'as' => 'patient_details'
                                    ]
                                ], [
                                    '$project' => [
                                        'firstName' => 1,
                                        'lastName' => 1,
                                        'email' => 1,
                                        'created_at' => 1,
                                        'details._id' => 1,
                                        'details.mob' => 1,
                                        'details.address' => 1,
                                        'patient_details._id' => 1,
                                        'patient_details.fbURLs' => 1,
                                        'patient_details.twitterURLs' => 1
                                    ]
                                ]
                    ]);
                }));
        $result = $data;
        if (!empty($result)) {
            echo $result->count();
            echo '<pre>';
            print_r($result->toArray());
        }
        die;
        return view('home');
    }

    public function create()
    {
        $query = new Doc1();
        $query->firstName = 'Krina Patel';
        $query->save();
        if(!empty($query->_id)){
            $query2 = new Doc2();
            $query2->userId = new ObjectID($query->_id);
            $query2->address = 'Ahmedabad';
            $query2->mob = '9999999999';
            $query2->save();
            
            $query3 = new Doc3();
            $query3->userId = new ObjectID($query->_id);
            $query3->fbURLs = 'www.krina1.com';
            $query3->twitterURLs = 'www.krina2.com';
            $query3->save();
        }
        echo '<pre>'; print_r($query);
        die;
    }
    
    public function edit(Request $request) {
        $id = $request->id;
        $data = Doc1::raw((function($collection) use ($id) {
                    return $collection->aggregate([
                                [
                                    '$match' => ["_id" => new ObjectID($id)]
                                ], [
                                    '$lookup' => [
                                        'from' => 'doc2',
                                        'localField' => '_id',
                                        'foreignField' => 'userId',
                                        'as' => 'details'
                                    ]
                                ], [
                                    '$unwind' => [
                                        'path' => '$details'
                                    ]
                                ], [
                                    '$lookup' => [
                                        'from' => 'doc3',
                                        'localField' => '_id',
                                        'foreignField' => 'userId',
                                        'as' => 'patient_details'
                                    ]
                                ], [
                                    '$project' => [
                                        'firstName' => 1,
                                        'lastName' => 1,
                                        'details._id' => 1,
                                        'details.mob' => 1,
                                        'details.address' => 1,
                                        'patient_details._id' => 1,
                                        'patient_details.fbURLs' => 1,
                                        'patient_details.twitterURLs' => 1
                                    ]
                                ]
                    ]);
                }));
        $result = $data->first();
        if (!empty($result)) {
            echo '<pre>';
            print_r($result->toArray());
        }
        die;
        return view('home');
    }
    
    public function update(Request $request) {
         $id = $request->id;
         $doc3 = Doc3::where('userId',new ObjectID($id))->first();
         $doc3->fbURLs = 'http://www.googleupdate.com';
         $doc3->twitterURLs = 'http://www.twitter7990update.com';
         $doc3->save();
         echo '<pre>'; print_r($doc3); die;
    }
    
    public function doc3Create(Request $request) {
         $doc3 = new doc3();
         $doc3->fbURLs = 'facebook';
         $doc3->twitterURLs = 'twitter';
         $doc3->save();
         echo '<pre>'; print_r($doc3); die;
    }
    
     public function doc3index(Request $request) {
         $doc3 = Doc3::get();
         echo '<pre>'; print_r($doc3->toArray()); die;
    }
     public function doc1update(Request $request) {
         $id = $request->id;
         $doc1 = Doc1::where('_id',new ObjectID($id))->first();
         $doc1->firstName = 'Dipen';
         $doc1->lastName = 'Patel';
         $doc1->email = 'dipen@gmail.com';
         $doc1->save();
         echo '<pre>'; print_r($doc1); die;
    }
}
