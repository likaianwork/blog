<?php

namespace app\Http\Model;

use Illuminate\Database\Eloquent\Model;


class config extends Model
{
   protected    $table="config";
    protected    $primaryKey="conf_id";
    public       $timestamps=false;
    protected    $guarded=[];
}
