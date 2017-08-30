<?php

namespace App\http\model;

use Illuminate\Database\Eloquent\Model;

class navs extends Model
{
    //
     protected $table='navs';
    protected $primaryKey='nav_id';
    public $timestamps=false;
    protected    $guarded=[];
}
