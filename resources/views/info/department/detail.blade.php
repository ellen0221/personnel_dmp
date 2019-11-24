@extends('common.layouts')

@section('content')
    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">具体岗位</div>

        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <th>岗位号</th>
                <th>岗位名称</th>
                <th>岗位简介</th>

            </tr>
            @foreach($info as $v)
            <tr>
                <td>{{ $v->id }}</td>
                <td>{{ $v->name }}</td>
                <td>{{ $v->introduction }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    <div align="center">
        <br>
        <a href="{{ url('api/department') }}">
            <button type="button"  style="width:100px;height:40px;">返回</button>
        </a>
    </div>
@stop