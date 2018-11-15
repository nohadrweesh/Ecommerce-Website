<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    //
    protected $table='manufacturers';
    protected $fillable=['name_ar','name_en','mobile','email','twitter','facebook','website','contact_name','lat','lang','logo'];
}
