@extends('common.layouts')

@section('content')

    @include('common.message')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default" style="width: 100%">
        <div class="panel-heading">部门列表</div>
        <div style="margin: 10px;">
            <div class="col-lg-1 pull-right" style="margin-right: 20px;">
                <a href="{{ url('api/department/create') }}">
                    <button type="button" class="btn btn-primary" style="height:45px;">新增部门</button>
                </a>
            </div>
            <form method="post" action="{{ url('api/department') }}">
                {{ csrf_field() }}
                <div class="col-lg-3 pull-right">
                    <div class="input-group">
                        <input type="text" class="form-control" style="height: 45px" name="keywords" placeholder="部门名/部门号">
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
                <th>部门号</th>
                <th>部门名称</th>
                <th>部门简介</th>
                <th>添加时间</th>
                <th width="250">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($info as $information)
                <tr>
                    <th scope="row">{{ $information->id }}</th>
                    <td>{{ $information->name }}</td>
                    <td>{{ $information->introduction }}</td>
                    <td>{{ $information->created_at }}</td>
                    <td>
                        <a href="{{ url('api/department/detail', ['id' => $information->id]) }}">具体岗位</a>&nbsp;
                        <a href="{{ url('api/department/update', ['id' => $information->id]) }}">修改</a>&nbsp;
                        <a href="{{ url('api/department/delete', ['id' => $information->id]) }}"
                            onclick="if (confirm('确定删除吗?') == false) return false;">删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{--<!-- 分页 -->--}}
    <div>
        <div align="center">
            {{ $info->links() }}
        </div>
    </div>

@stop
