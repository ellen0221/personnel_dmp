@extends('common.layouts')

@section('content')

    @include('common.message')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">岗位列表</div>
        <div style="margin: 10px;">
            <div class="col-lg-1 pull-right" style="margin-right: 20px;">
                <a href="{{ url('api/post/create') }}">
                    <button type="button" class="btn btn-primary" style="height: 45px">新增岗位</button>
                </a>
            </div>
            <form method="post" action="{{ url('api/post') }}">
                {{ csrf_field() }}
                <div class="col-lg-3 pull-right">
                    <div class="input-group">
                        <input type="text" class="form-control" style="height: 45px" name="keywords" placeholder="岗位名/岗位号">
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
                <th>岗位号</th>
                <th>岗位名称</th>
                <th>所属部门</th>
                <th>岗位简介</th>
                <th>岗位等级</th>
                <th>添加时间</th>
                <th width="150">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($info as $v)
                <tr>
                    <th scope="row">{{ $v->id }}</th>
                    <td>{{ $v->name }}</td>
                    <td>{{ $v->dep_name }}</td>
                    <td>{{ $v->introduction or '-' }}</td>
                    <td>{{ $v->level }}</td>
                    <td>{{ $v->created_at }}</td>
                    <td>
                        <a href="{{ url('api/post/update', ['id' => $v->id]) }}">修改</a>&nbsp;
                        <a href="{{ url('api/post/delete', ['id' => $v->id]) }}"
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
