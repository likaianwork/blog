@extends('layouts.admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 全部导航
</div>
<!--面包屑导航 结束-->

{{--<!--结果页快捷搜索框 开始-->--}}
{{--<div class="search_wrap">--}}
    {{--<form action="" method="post">--}}
        {{--<table class="search_tab">--}}
            {{--<tr>--}}
                {{--<th width="120">选择分类:</th>--}}
                {{--<td>--}}
                    {{--<select onchange="javascript:location.href=this.value;">--}}
                        {{--<option value="">全部</option>--}}
                        {{--<option value="http://www.baidu.com">百度</option>--}}
                        {{--<option value="http://www.sina.com">新浪</option>--}}
                    {{--</select>--}}
                {{--</td>--}}
                {{--<th width="70">关键字:</th>--}}
                {{--<td><input type="text" name="keywords" placeholder="关键字"></td>--}}
                {{--<td><input type="submit" name="sub" value="查询"></td>--}}
            {{--</tr>--}}
        {{--</table>--}}
    {{--</form>--}}
{{--</div>--}}
{{--<!--结果页快捷搜索框 结束-->--}}

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/navs/create')}}"><i class="fa fa-plus"></i>添加导航</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                  
                    <th>导航名称</th>
                    <th>导航别名</th>
                    <th>导航地址</th>
                    <th>排序</th>
                    <th>操作</th>
                </tr>

          @foreach($data as $v=>$k)
                <tr>
                   
                    <td class="tc">{{$k->nav_name}}</td>
               
                      <td class="tc">{{$k->nav_alias}}</td>
            
                     <td>{{$k->nav_url}}</td>
                    <td>{{$k->nav_order}}</td>
                    <td>
                        <a href="{{url('admin/navs/'.$k->nav_id.'/edit')}}">修改</a>
                        <a href="javascript:;" onclick=del({{$k->nav_id}}) >删除</a>
                    </td>
                </tr>
            @endforeach
          
            </table>
            <div class="page_list">
         
</div>
</form>
<style>
    .result_content ul li span{
        font-size :15px;
        padding :6px,12px;
    }
</style>
<script>
function del(nav_id){
     layer.confirm(
        '你确定要删除这篇文章么',
        { btn:['确定','取消']},
        function(){
            $.post(
                "{{url('admin/navs/')}}/"+ nav_id,
                {'_method':'delete','_token':"{{csrf_token()}}"},
                function(data){
                     if(data.status==0){
                        location.href=location.href;
                        layer.msg(data.msg,{icon:6});

                     }else{
                        layer.msg(data.msg,{icon :5})
                     }

                 })
                
             },
        
        function(){

        })
}
</script>
