<?php
namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use App\PatientDetail;


class PatientDetail extends Model 
{
    use SoftDeletes;
    use HybridRelations;
    
    protected $connection = 'mongodb';
    protected $collection = 'patient_details';
}