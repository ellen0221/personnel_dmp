@extends('common.stafflayouts')

@section('content')

    @include('common.message')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default" style="width: 100%">
        <div class="panel-heading">选课</div>
        <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <th>课程名称</th>
                <th>课程老师</th>
                <th>课程简介</th>
                <th>教材</th>
                <th>开始时间</th>
                <th>结束时间</th>
                <th width="150">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($info as $information)
                <tr>
                    <th scope="row">{{ $information->name }}</th>
                    <td>{{ $information->teacher }}</td>
                    <td>{{ $information->introduction }}</td>
                    <td>{{ $information->book }}</td>
                    <td>{{ $information->start_time }}</td>
                    <td>{{ $information->end_time }}</td>
                    <td>
                        <a href="{{ url('api/staff/selected', ['id' => $information->id]) }}">选课</a>&nbsp;
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- 分页 -->
    <div>
        <div class="pull-right">
            {{ $info->render() }}
        </div>
    </div>

@stop
