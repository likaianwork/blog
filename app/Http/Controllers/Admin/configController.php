<?php


namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Model\config;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

error_reporting( E_ALL&~E_NOTICE );
class configController extends CommonController
{
    //

       public function index()
    {
        $data = Config::orderBy('conf_order','asc')->get();
        foreach ($data as $k=>$v){
            switch ($v->field_type){
                case 'input':
                    $data[$k]->_html = '<input type="text" class="lg" name="conf_content[]" value="'.$v->conf_content.'">';
                    break;
                case 'textarea':
                    $data[$k]->_html = '<textarea type="text" class="lg" name="conf_content[]">'.$v->conf_content.'</textarea>';
                    break;
                case 'radio':
                    //1|开启,0|关闭
                    $arr = explode(',',$v->field_value);
                    $str = '';
                    foreach($arr as $m=>$n){
                        //1|开启
                        $r = explode('|',$n);
                        $c = $v->conf_content==$r[0]?' checked ':'';
                        $str .= '<input type="radio" name="conf_content[]" value="'.$r[0].'"'.$c.'>'.$r[1].'　';
                    }
                    $data[$k]->_html = $str;
                    break;
            }

        }
        return view('admin.config.index',compact('data'));
    }
    public function store(){
        $input=Input::except('_token');
        //dd($input);
        $rules=[
           'conf_name'=>'required',
           'conf_title'=>'required'
        ];

        $re=[
             'conf_name.required'=>'配置名称名称不能为空',
             'conf_title.required'=>'配置标题不能为空'
        ];
        $validator=Validator::make($input,$rules,$re);
        if($validator->passes()){
            $re=config::create($input);
            if($re){
                return redirect('admin/config');
            }else{
                return back()->with('errors','插入失败');
            }

        }else{
             return back()->withErrors($validator);
        }


    }
    public function edit($config_id)
    {
        $data= config::find($config_id);
       //dd($data);
       return view('admin/config/edit',compact('data'));

    }
    public function update($config_id){
        $data= input::except('_token','_method');
       // dd($data);
        $re= config::where('conf_id',$config_id)->update($data);
    
       if($re){
        return redirect('admin/config');
       }else{
        return back()->with('error','修改失败');
       }

    }
    public function destroy($config_id){
         $re= config::where('conf_id',$config_id)->delete();
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
      public function changeContent()
    {
        $input = Input::all();
        foreach($input['conf_id'] as $k=>$v){
        //$this->putFile();
            Config::where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$k]]);
        }
        $this->putFile();
        return back()->with('errors','配置项更新成功！');
    }
    //将数据些入配置文件中去
    public function putFile(){
      $config=config::pluck('conf_content','conf_name')->all();
      //dd($config);
      //写入文件的文件名
      $path=base_path().'\config\web.php';
      $str='<?php return ' . var_export($config,true).';';
      file_put_contents($path,$str);
    }
}