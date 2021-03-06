<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table='countries';
    protected $fillable=['name','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];

    public function doctors(){

        return $this->hasManyThrough('App\Models\Doctor','App\Models\Hospital','country_id','hospital_id','id','id');
    }
    public function hospitals(){

        return $this->hasMany('App\Models\Hospital','country_id','id');
    }
    //
}
