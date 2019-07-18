<?php
namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class UserDetail extends Model 
{
    use SoftDeletes;
    use HybridRelations;
    
    protected $connection = 'mongodb';
    protected $collection = 'users';
}