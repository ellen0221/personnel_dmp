@extends('common.layouts')

@section('content')

    @include('common.message')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">培训课程列表</div>
        <div style="margin: 10px;">
            <div class="col-lg-1 pull-right" style="margin-right: 20px;">
                <a href="{{ url('api/course/create') }}">
                    <button type="button" class="btn btn-primary" style="height: 45px">新增课程</button>
                </a>
            </div>
            <form method="post" action="{{ url('api/course') }}">
                {{ csrf_field() }}
                <div class="col-lg-3 pull-right">
                    <div class="input-group">
                        <input type="text" class="form-control" style="height: 45px" name="keywords" placeholder="课程名/课程号">
                        <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" style="height: 45px">搜索</button>
                    </span>
                    </div>
                </div>
            </form>
        </div>
        <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <th>课程号</th>
                <th>课程名称</th>
                <th>课程简介</th>
                <th>授课人</th>
                <th>教材</th>
                <th>开始时间</th>
                <th>结束时间</th>
                {{--<th>选课人数</th>--}}
                <th width="250">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($info as $v)
                <tr>
                    <th scope="row">{{ $v->id }}</th>
                    <td>{{ $v->name }}</td>
                    <td>{{ $v->introduction }}</td>
                    <td>{{ $v->teacher }}</td>
                    <td>{{ $v->book }}</td>
                    <td>{{ $v->start_time or '-' }}</td>
                    <td>{{ $v->end_time or '-' }}</td>
                    {{--<td>{{ $v->select_num }}</td>--}}
                    <td>
                        <a href="{{ url('api/course/detail', ['id' => $v->id]) }}">选课情况</a>&nbsp;
                        <a href="{{ url('api/course/update', ['id' => $v->id]) }}">修改</a>&nbsp;
                        <a href="{{ url('api/course/delete', ['id' => $v->id]) }}"
                            onclick="if (confirm('确定删除吗?') == false) return false;">删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- 分页 -->
    <div>
        <div align="center">
            {{ $info->links() }}
        </div>
    </div>

@stop
