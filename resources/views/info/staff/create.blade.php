@extends('common.layouts')

@section('content')

    @include('common.message')
    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">新增职工信息</div>
        <div class="panel-body">
            @include('info.staff.form')
            {{--@include('info.staff.testform')--}}
        </div>
    </div>

@stop