@extends('common.layouts')

@section('content')

    @include('common.message')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">职工列表</div>
        <div style="margin: 10px;">
            <div class="col-lg-1 pull-right" style="margin-right: 20px;">
                <a href="{{ url('api/info/create') }}">
                    <button type="button" class="btn btn-primary" style="height: 45px">新增职工</button>
                </a>
            </div>
            <form method="post">
                {{ csrf_field() }}
                <div class="col-lg-3 pull-right">
                    <div class="input-group">
                        <input type="text" class="form-control" style="height: 45px" name="keywords" placeholder="姓名/职工号">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" style="height: 45px">搜索</button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th><a name="sort" href="{{ url('api/info/index', ['sort' => !$sort]) }}">职工号</a></th>
                <th>真实姓名</th>
                <th>用户名</th>
                <th>所属部门</th>
                <th>目前岗位</th>
                <th>添加时间</th>
                <th width="400px">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($info as $information)
                <tr>
                    <th scope="row">{{ $information->id }}</th>
                    <td>{{ $information->truename }}</td>
                    <td>{{ $information->username }}</td>
                    <td>{{ $information->dep_name or '-' }}</td>
                    <td>{{ $information->post_name or '-' }}</td>
                    <td>{{ $information->created_at or '-' }}</td>
                    <td>
                        <a href="{{ url('api/info/detail', ['id' => $information->id]) }}">详情</a>&nbsp;
                        <a href="{{ url('api/info/update', ['id' => $information->id]) }}">修改</a>&nbsp;
                        <a href="{{ url('api/info/delete', ['id' => $information->id]) }}"
                            onclick="if (confirm('确定删除吗?') == false) return false;">删除</a>
                        <a href="{{ url('api/info/salary',['id' => $information->id]) }}">工资情况</a>&nbsp;
                        @if($information->is_admin)
                            <a href="{{ url('api/info/canceladmin', ['id' => $information->id]) }}" onclick="if (confirm('确定取消管理员权限吗?') == false) return false;">取消管理员</a>&nbsp;
                        @else
                            <a href="{{ url('api/info/setadmin', ['id' => $information->id]) }}" onclick="if (confirm('确定设为管理员吗?') == false) return false;">设为管理员</a>&nbsp;
                        @endif
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
