<?php

namespace app\Http\Model;

use Illuminate\Database\Eloquent\Model;


class links extends Model
{
   protected    $table="links";
    protected    $primaryKey="links_id";
    public       $timestamps=false;
    protected    $guarded=[];
}
