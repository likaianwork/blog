<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\navs;
class navscontroller extends CommonController
{
    //
    public function index(){
        $data=navs::all();
      //  dd($data);
        return view('admin/navs/index',compact('data'));
    }
    public function store(){
      $data=input::except('_token');
      $re=[
         'nav_name'=>'required',
         'nav_url'=>'required',
         ];
         $rule=[
         'nav_name.required'=>'名称不能为空',
         'nav_url.required'=>'地址不能为空'

         ];
      $validator= validator::make($data,$re,$rule);
      if($validator->passes()){
         $re=navs::create($data);
         if($re){
            return redirect('admin/navs');
         }else{
            return back()->with('errors','插入失败');
         }

      }else{
        return back()->withErrors($validator);

      }

    }
    public function create(){


        return view('admin/navs/add');
    }
    public function edit($nav_id){
        $data= navs::find($nav_id);
        //dd($data);
        return view('admin/navs/edit',compact('data'));

    }
    public function update($nav_id){
        $input= input::except('_method','_token');
        //dd($input);
        $re= navs::where('nav_id',$nav_id)->update($input);
       if($re){
            return redirect('admin/navs');

        }else{
            return back()->with('errors','修改失败');
        }
        
    }
    public function destroy($nav_id){

        $re= navs::where('nav_id',$nav_id)->delete();
        if($re){
             $data=[
            'status'=>0,
            'msg'=>'删除成功',
            ];

        }else{
            $data=[
            'status'=>1,
            'msg'=>'删除失败',
            ];

        }
        return $data;
    }
}
