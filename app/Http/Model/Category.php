<?php

namespace app\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
 
    protected $table="category";
    protected $primaryKey="cate_id";
    public $timestamps=false;
    protected $guarded=[];

    //获取无限极分类
    public function tree(){
        $cates= $this->orderBy('cate_order','dsc')->get();
        $data= $this->getTree($cates,'cate_name','cate_id','cate_pid');
        return $data;

    }
    //无限极分类
    public  function getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid=0){
        $arr = array();
        foreach ($data as $k=>$v){
            if($v->$field_pid==$pid){
                $data[$k]["_".$field_name] = $data[$k][$field_name];
                $arr[] = $data[$k];
                foreach ($data as $m=>$n){
                    if($n->$field_pid == $v->$field_id){
                        $data[$m]["_".$field_name] = '--'.$data[$m][$field_name];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }
    
}
