@extends('layouts.admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 添加网站链接
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
    <form action="{{url('admin/links')}}" method="post">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            
            <tr>
                <th><i class="require">*</i>网站链接名称：</th>
                <td>
                    <input type="text" name="links_name">
                    <span><i class="fa fa-exclamation-circle yellow"></i>分类名称必须填写</span>
                </td>
            </tr>
            <tr>
                <th>链接内容：</th>
                <td>
                    <input type="text" class="lg" name="links_title">
                </td>
            </tr>
            <tr>
                <th>排序</th>
                <td>
               <input type="text" name="links_order"
                </td>
            </tr>
          
            <tr>
                <th>链接地址</th>
                <td>
                    <input type="text" class="sm" name="links_url">
                </td>
            </tr>
            <tr>
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

@endsection