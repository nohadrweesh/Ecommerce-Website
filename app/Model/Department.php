<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $table='departments';
    protected $fillable=['dep_name_ar','dep_name_en','icon','description','keywords','parent_id'];


    public function departments(){
    	return $this->hasMany('App\Model\Department','id','parent_id');
    }

 
}
