@extends('common.layouts')

@section('content')

    {{--@include('common.validator')--}}
    @include('common.message')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">{{ $truename }} - 工资情况</div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>基本工资</th>
                <th>级别工资</th>
                <th>公积金</th>
                <th>时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach($info as $v)
                <tr>
                    <td>{{ $v->basic }}</td>
                    <td>{{ $v->level or '-' }}</td>
                    <td>{{ $v->fund or '-' }}</td>
                    <td>{{ date("Y-m",strtotime($v->time)) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    <div align="center">
        <br>
        <a href="{{ url('api/info/index') }}" style="text-decoration: none;">
            <button type="button"  style="width:100px;height:40px;">返回</button>
        </a>
        <a href="{{ url('api/info/salary/add', ['staff_id' => $id]) }}" style="margin-left: 20px; text-decoration: none;">
            <button type="button"  style="width:100px;height:40px;">工资录入</button>
        </a>
    </div>
@stop