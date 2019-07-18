<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/phpinfo', 'HomeController@phpinfo')->name('phpinfo');
Route::get('/mongo', 'HomeController@mongoConnect')->name('mongo');

Route::get('/patientdetails', 'PatientDetailController@index')->name('patientdetails');
Route::get('/insurances', 'InsuranceController@index')->name('insurances');
Route::get('/patientinsurances', 'PatientInsuranceController@index')->name('patientinsurances');

Route::get('/patients', 'PatientController@index')->name('patients');
Route::get('/patients/create', 'PatientController@create')->name('patients.create');
Route::get('/patients/edit/{id}', 'PatientController@edit')->name('patients.edit');
Route::get('/patients/update/{id}', 'PatientController@update')->name('patients.update');
Route::get('/doc3/create', 'PatientController@doc3Create')->name('doc3.create');
Route::get('/doc3', 'PatientController@doc3index')->name('doc3.index');
Route::get('/doc1/update/{id}', 'PatientController@doc1update')->name('doc1.update');


