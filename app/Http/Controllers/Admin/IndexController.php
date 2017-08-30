<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\User;
class IndexController extends CommonController
{
    public function index()
    {
        return view('admin.index');
    }

    public function info()
    {
        return view('admin.info');
    }
    public function pass(){
        if($input = Input::all()){
          
            //验证规则
            $rules = [
                'password'=>'required|between:6,20|confirmed',
            ];

            $message = [
                'password.required'=>'新密码不能为空！',
                'password.between'=>'新密码必须在6-20位之间！',
                'password.confirmed'=>'新密码和确认密码不一致！',
            ];
            //在表单name属性中加入一个password_confirmation
            $validator = Validator::make($input,$rules,$message);
           //dd($validator);
           //validator->passes()是判断验证是否成功
           //dd($validator->passes());
           if($validator->passes()) {
                 $user=User::first();
                 //解析原密码
                 $_password=Crypt::decrypt($user->password);

                 if($_password==$input['password_o'])
                 {
                     $password=Crypt::encrypt($input['password']);
                     $user->password=$password;
                     $user->update();
                   //  return redirect('admin/index');


                 }else{
                    return back()->with('error','原密码不正确');
                 }
             }else{
                return back()->withErrors($validator);
             }

        }
       return view('admin.pass');
    }
}
