@extends('common.layouts')

@section('content')

    {{--@include('common.validator')--}}

    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">修改课程信息</div>
        <div class="panel-body">
            @include('info.course.form')
        </div>
    </div>

@stop