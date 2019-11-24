<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>人事信息管理系统 - @yield('title')</title>
    <link href="{{ asset('static/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <style>
        .button:hover {
            cursor: pointer;
        }
    </style>

    @section('style')
    @show
</head>
<body>

<!-- 头部 -->
@section('header')
    <div class="header">
        <div style="width: 600px; margin: 0 auto;">
            <div class="" style="width: auto; float:left;">
                <h2 style="font-size: 30px; margin-left: 200px; padding: 15px 0;">人事信息管理系统</h2>
            </div>
        </div>
        <div style="position:relative; float: right; width: auto; padding-right: 15px; padding-top: 10px;">
            <a href="{{ url('/stafflogout') }}" style="margin-left: 20px; float: right;">退出</a>
            <a style="float: right;" href="{{ url('staffreset') }}">重置密码</a>
        </div>
    </div>
@show

<!-- 中间内容区域 -->
<div class="center">

    <!-- 左侧菜单区域 -->
    <div class="leftmenu">
        {{--@yield('leftmenu')--}}
        @section('leftmenu')
            <div class="menu">
                <ul>
                    <li><a href="{{ url('api/staff/index') }}" style="{{ strstr(app('request')->getPathInfo(),'/api/staff/index') ? 'background-color: #555;color: white;' : '' }}">个人信息</a></li>
                    <li><a href="{{ url('api/staff/reward') }}" style="{{ strstr(app('request')->getPathInfo(),'/api/staff/reward') ? 'background-color: #555;color: white;' : '' }}">奖惩记录</a></li>
                    <li><a href="{{ url('api/staff/course') }}" style="{{ strstr(app('request')->getPathInfo(),'/api/staff/course') ? 'background-color: #555;color: white;' : '' }}">选课</a></li>
                    <li><a href="{{ url('api/staff/record') }}" style="{{ strstr(app('request')->getPathInfo(),'/api/staff/record') ? 'background-color: #555;color: white;' : '' }}">选课记录</a></li>
                    <li><a href="{{ url('api/staff/salary') }}" style="{{ strstr(app('request')->getPathInfo(),'/api/staff/salary') ? 'background-color: #555;color: white;' : '' }}">工资记录</a></li>
                </ul>
            </div>
        @show
    </div>
</div>

<!-- 尾部 -->
@section('footet')
    <div class="lfooter">
        <span style="font-size: 16px;"> @Copyright © 2019 xj.</span>
    </div>
@show

<!-- 右侧内容区域 -->
<div class="content">

    @yield('content')


</div>

<!-- jQuery 文件 -->
<script src="{{ asset('static/js/jquery.min.js') }}"></script>
<!-- Bootstrap JavaScript 文件 -->
<script src="{{ asset('static/js/bootstrap.min.js') }}"></script>
@section('js')

@show

</body>
</html>
