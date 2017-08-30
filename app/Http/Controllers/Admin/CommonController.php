<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //
    public function upload(){
        //图片上传
        //input::file（） 获取表单提交过来的
        $file=Input::file('Filedata');
        if($file->isValid()){
            //检测是否是上传的文件
            $entension= $file->getClientOriginalExtension();//获取上传文件的后缀
            $newname=date('YmdHis').mt_rand(100,999).'.'.$entension;
            //移动文件
            $filepath= $file->move(base_path().'/uploads',$newname);
            //上传文件路径
            
            $filepath='uploads/'.$newname;
            return $filepath;
        }
    }
}
