@extends('common.layouts')

@section('content')
    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">职工信息详情</div>

        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <td width="50%">职工号</td>
                <td>{{ $info->id }}</td>
            </tr>
            <tr>
                <td>真实姓名</td>
                <td>{{ $info->truename }}</td>
            </tr>
            <tr>
                <td>用户名</td>
                <td>{{ $info->username }}</td>
            </tr>
            <tr>
                <td>年龄</td>
                <td>{{ $info->age or '-' }}</td>
            </tr>
            <tr>
                <td>性别</td>
                <td>
                    @if($info->sex == 1)
                        男
                    @elseif($info->sex == 2)
                        女
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <td>学历</td>
                <td>{{ $info->education or '-' }}</td>
            </tr>
            <tr>
                <td>所属部门</td>
                <td>{{ $info->dep_name or '-' }}</td>
            </tr>
            <tr>
                <td>目前岗位</td>
                <td>{{ $info->post_name or '-' }}</td>
            </tr>
            <tr>
                <td>添加日期</td>
                <td>{{ $info->created_at }}</td>
            </tr>
            <tr>
                <td>最后修改</td>
                <td>{{ $info->updated_at }}</td>
            </tr>
            </tbody>
        </table>

    </div>
    <div align="center">
        <br>
        <a href="{{ url('api/info/index') }}">
            <button type="button"  style="width:100px;height:40px;">返回</button>
        </a>
    </div>
@stop