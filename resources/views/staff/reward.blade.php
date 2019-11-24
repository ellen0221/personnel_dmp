@extends('common.stafflayouts')

@section('content')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default" style="width: 100%">
        <div class="panel-heading">奖惩记录</div>
        <table class="table table-hover table-striped table-responsive">
            <thead>
            <tr>
                <th>奖惩类型</th>
                <th>项目名称</th>
                <th>项目描述</th>
                <th>奖惩金额</th>
                <th>时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach($info as $information)
                <tr>
                    <th scope="row">
                        @if($information->type == 0)
                            惩罚
                        @else
                            奖励
                        @endif
                    </th>
                    <td>{{ $information->name }}</td>
                    <td>{{ $information->description }}</td>
                    <td>{{ $information->money }}</td>
                    <td>{{ $information->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@stop
