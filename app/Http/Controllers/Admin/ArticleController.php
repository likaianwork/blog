<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Category;
use App\Http\Model\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


class ArticleController extends CommonController
{
    //
    public function index(){
      //  $info= new Article;
       // $art=$info->Tree();
       // $cats=$info->getTree($data);
       $data=Article::orderBy('art_id','desc')->paginate(4);


        return view('admin/article/index',compact('data'));

    }
    public function create(){
       // $data=Category::where('cate_pid',0)->get();
        //compact php函数。
        $data=(new Category)->tree();
       // dd($data);
       

        return view('admin/article/add')->with('data',$data);


    }
    public function store(){
        //剔除—token 的值
        $input=input::except('_token');
        $input['art_time']= time();
      
        //验证规则
        $rules=[
            'art_title'=>'required',
            'art_content'=>'required',


        ];
        $message=[
        'art_title.required'=>'标题不能为空',
        'art_content.required'=>'内容不能为空',
        ];
        //错误内容
        // 表单验证
       $validator= validator::make($input,$rules,$message);
       if($validator->passes()){
        

           $re = Article::create($input);
         
           if($re){
            return redirect('admin/article');

           }else{
             return back()->with('error','添加文件失败。请重试');
           }
       }else{
              return back()->withErrors($validator);
           }
            
       

    }
    public function edit($art_id){
        $data=(new Category)->tree();
        $fild=article::find($art_id);
        //dd($data);
        return view('admin/article/edit',compact('data','fild'));

    }
    
    public function show(){

    }
    public function update($art_id){
          $input= input::except('_token','_method');
          $re=Article::where('art_id',$art_id)->update($input);
    if($re){
        return redirect('admin/article');
    }else{
        return back()->with('error','修改文章失败');
        }

    }
    public function destroy($art_id){
        $re= Article::where('art_id',$art_id)->delete();
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
