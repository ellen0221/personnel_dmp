@extends('common.layouts')

@section('content')
    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">【 {{ $course_name }} 】选课情况</div>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>职工号</th>
                <th>职工姓名</th>
                <th>成绩</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($info as $v)
                <tr>
                    <td scope="row">{{ $v->staff_id }}</td>
                    <td>{{ $v->truename }}</td>
                    <td>{{ $v->grade }}</td>
                    <td><a href="{{ url('api/course/grade', ['id' => $v->id]) }}">录入成绩</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    <div align="center">
        <br>
        <a href="{{ url('api/course') }}">
            <button type="button"  style="width:100px;height:40px;">返回</button>
        </a>
    </div>
@stop
