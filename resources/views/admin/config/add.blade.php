@extends('layouts.admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 添加配置项
</div>
<div class="result_wrap">
    <div class="result_title">
        <h3>快捷操作</h3>
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="#"><i class="fa fa-plus"></i>新增网站链接</a>
            <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
            <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->
<div class="result_wrap">
    <div class="result_title">
        <h3>添加配置</h3>
        @if(count($errors)>0)
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            
        @endif
        </div>


<div class="result_wrap">
    <form action="{{url('admin/config')}}" method="post">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            
            <tr>
                <th><i class="require">*</i>配置名称：</th>
                <td>
                    <input type="text" name="conf_name">
                    <span><i class="fa fa-exclamation-circle yellow"></i>分类名称必须填写</span>
                </td>
            </tr>
            <tr>
                <th>配置标题：</th>
                <td>
                    <input type="text" class="lg" name="conf_title">
                </td>
            </tr>
            <tr>
                <th>配置类型</th>
                <td>
                    <input type="radio" class="sm" name="field_type" value="input"　onclick="showTr()" >input　
                    <input type="radio" class="sm" name="field_type" value="textarea" onclick="showTr()" >textarea　
                    <input type= "radio" class="sm" name="field_type" value="radio" onclick="showTr()" >radio　 
                </td>
            </tr>
             <tr class="field_value">
                <th>类型值</th>
                <td>
                    <input type="text" class="sm" name="field_value">
                    <p><i class="fa fa-exclamation-circle yellow"></i>只有在radio的情况下显示。0 代表开启。1代表关闭</p>
                </td>
            </tr>
            
            <tr>
                <th>排序</th>
                <td>
               <input type="text" name="conf_order">
                </td>
            </tr>
            <tr>
                <th>说明</th>
                <td>
                <textarea name="conf_tips" id="" cols="30" rows="10"></textarea>
                </td>
            </tr>
           </tbody>

         <th></th>
                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
            </table>
                
    </form>
</div>
<script>
showTr();

function showTr(){
    var type=$('input[name=field_type]:checked').val();
    if(type=='radio'){
    
        $('.field_value').show();

    }else{
        $('.field_value').hide();

    }

}
</script>

@endsection