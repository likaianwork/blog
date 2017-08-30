<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Model\links;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class linksController extends CommonController
{
    //
  public function index(){
      $data=links::all();
      return view('admin/links/index',compact('data'));
    }
    public function create(){
      return view('admin/links/add');
    }
    public function store(){
        $input=Input::except('_token');
        $rules=[
           'links_name'=>'required',
           'links_url'=>'required'
        ];

        $re=[
             'links_name.required'=>'名称不能为空',
             'links_url.required'=>'链接地址不能为空'
        ];
        $validator=Validator::make($input,$rules,$re);
        if($validator->passes()){
            $re=Links::create($input);
            if($re){
                return redirect('admin/links');
            }else{
                return back()->with('errors','插入失败');
            }

        }else{
             return back()->withErrors($validator);
        }


    }
    public function edit($links_id)
    {
        $data= links::find($links_id);
       //dd($data);
       return view('admin/links/edit',compact('data'));

    }
    public function update($links_id){
        $data= input::except('_token','_method');
        $re= links::where('links_id',$links_id)->update($data);
    
       if($re){
        return redirect('admin/links');
       }else{
        return back()->with('error','修改失败');
       }

    }
    public function destroy($links_id){
         $re= links::where('links_id',$links_id)->delete();
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
