@extends('common.layouts')

@section('content')

    @include('common.message')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">奖惩列表</div>
        <form method="post">
            {{ csrf_field() }}
            <div style="margin: 10px;">
                <div class="col-lg-1 pull-right">
                    <a href="{{ url('api/reward/create') }}">
                        <button type="button" class="btn btn-primary" style="height: 45px;">新增奖惩</button>
                    </a>
                </div>
                <form method="post" action="{{ url('api/reward') }}">
                    {{ csrf_field() }}
                    <div>
                        <div>
                            <button class="btn btn-primary" type="submit" style="height: 45px; width: 82px; float: right; margin-right: 8px;">搜索</button>
                            <input type="text" class="form-control" style="height: 45px; width: 180px; float:right;" name="keywords" placeholder="项目名/项目号">
                        </div>
                        <select name="type" style="height: 45px; width: 120px; float: right; margin-right: 20px; border-radius: 4px;">
                            <option value="">奖惩类型</option>
                            <option value="1">奖励</option>
                            <option value="2">惩罚</option>
                        </select>
                    </div>
                </form>
            </div>
        </form>
        <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <th>项目ID</th>
                <th>项目名称</th>
                <th>项目简介</th>
                <th>奖惩金额</th>
                <th>奖惩类型</th>
                <th width="250">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($info as $v)
                <tr>
                    <th scope="row">{{ $v->id }}</th>
                    <th>{{ $v->name }}</th>
                    <td>{{ $v->description }}</td>
                    <td>{{ $v->money }}</td>
                    <td>{{ $v->type == 1 ? '奖励' : '惩罚' }}</td>
                    <td>
                        <a href="{{ url('api/reward/update', ['id' => $v->id]) }}">修改</a>&nbsp;
                        <a href="{{ url('api/reward/staff', ['id' => $v->id]) }}">具体职工</a>&nbsp;
                        <a href="{{ url('api/reward/delete', ['id' => $v->id]) }}"
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
