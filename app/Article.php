<?php

namespace app\Http\model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model

{
    //
    protected $table      ='article';
    protected $primaryKey ='art_id';
    public $primaryKey= false; 
    protected $guarded=[];
}
