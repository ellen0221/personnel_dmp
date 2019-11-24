@extends('common.stafflayouts')

@section('content')

    @include('common.message')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default" style="width: 100%">
        <div class="panel-heading">工资详情</div>
        <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <th>基本工资</th>
                <th>级别工资</th>
                <th>公积金</th>
                <th>发放时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach($information as $info)
                <tr>
                    <td>{{ $info->basic }}</td>
                    <td>{{ $info->level }}</td>
                    <td>{{ $info->fund }}</td>
                    <td>{{ $info->time }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@stop
