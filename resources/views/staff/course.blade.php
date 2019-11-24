@extends('common.stafflayouts')

@section('content')

    @include('common.message')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default" style="width: 100%">
        <div class="panel-heading">选课记录</div>
        <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <th>课程名称</th>
                <th>课程老师</th>
                <th>课程简介</th>
                <th>教材</th>
                <th>开始时间</th>
                <th>结束时间</th>
                <th>选课时间</th>
                <th>成绩</th>
            </tr>
            </thead>
            <tbody>
            @foreach($info as $information)
                <tr>
                    <td>{{ $information->name }}</td>
                    <td>{{ $information->teacher }}</td>
                    <td>{{ $information->introduction }}</td>
                    <td>{{ $information->book }}</td>
                    <td>{{ $information->start_time }}</td>
                    <td>{{ $information->end_time }}</td>
                    <td>{{ $information->created_at }}</td>
                    <td>{{ $information->grade }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@stop
