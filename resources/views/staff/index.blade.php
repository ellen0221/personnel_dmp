@extends('common.stafflayouts')

@section('content')

    @include('common.message')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default" style="width: 100%">
        <div class="panel-heading">个人信息</div>
        <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <th>职工号</th>
                <th>姓名</th>
                <th>年龄</th>
                <th>性别</th>
                <th>学历</th>
                <th>所属部门</th>
                <th>目前岗位</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">{{ $information->id }}</th>
                    <td>{{ $information->truename }}</td>
                    <td>{{ $information->age }}</td>
                    <td>
                        @if($information->sex == 1)
                            男
                        @elseif($information->sex == 2)
                            女
                        @endif
                    </td>

                    <td>{{ $information->education }}</td>
                    <td>
                        @if(isset($data['department_name']))
                            {{ $data['department_name'] }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if(isset($data['post_name']))
                        {{ $data['post_name'] }}
                        @else
                        -
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('api/staff/edit') }}">修改</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

@stop
