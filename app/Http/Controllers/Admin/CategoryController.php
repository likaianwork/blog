<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Category;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
class CategoryController extends CommonController
{
    //get admin/category
    //展示分类 
    public function index(){
        $info= new Category;
        $cats=$info->Tree();
       // $cats=$info->getTree($data);


        return view('admin/category/index')->with('data',$cats);

    }
   //post admin/category
  
    public function store(){
        //
      $input= Input::except('_token');
      $rule=[
      'cate_name'=>'required',
      ];
      $message=[
      'cate_name.required'=>'分类名称不能为空',
      ];
      //验证表单
     $validator= validator::make($input,$rule,$message);
     //passes fangfa 
     if($validator->passes()){
       $cate=Category::create($input);
       if($cate){
  
        return redirect('admin/category');
    }else{
        return back()->with('error','数据填充失败');

    }
        

     }else{
        return back()->withErrors($validator);
     }


    }
    //get. admin/category/create
    //添加分类
    public function create(){
        $data=Category::where('cate_pid',0)->get();
        //compact php函数。
       

        return view('admin/category/add',compact('data'));


    }
    //get.admin/category/{}
    //显示单个信息
    public function show(){

    }
    //delect admin/category/{}
    //删除信息
    public function destroy($cate_id){
     $cate= Category::where('cate_id',$cate_id)->delete();
     if($cate){
          category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
            $data=[
             'status'=>0,
             'msg'=>'删除成功'
             ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'删除失败,请重试'
              ];
        }
     return $data;
    //put admin/category/()
    //更新数据
    }
    public function update($cate_id){   
        $input=Input::except('_token','_method');
      
        $re=category::where('cate_id',$cate_id)->update($input);

        if($re){
        return redirect('admin/category');

        }else{
            return back()->with('error','修改数据失败');
            dd(22);
        }

    }
    //get.admin/category/{}/edit
    //编辑分类
    public function edit($cate_id){
        $cate= Category::find($cate_id);
        $data=category::where('cate_pid',0)->get();
        //dd($cate);
      return view('admin.category.edit',compact('data','cate'));
    }
    //修改cate_order 排序
    public function changeorder(){
        $input=Input::all();

        $cate=Category::find($input['cate_id']);
        //dd($cate);
        $cate->cate_order=$input['cate_order'];
        $re=$cate->update();
        if($re){
            $data=[
            'status'=>0,
            'msg'   =>'分类排序成功',
            ];
        }else{
            $data=[
            'status'=>1,
            'msg'=>'分类排序失败',
            ];
        }
        return $data;
    

    }
}
