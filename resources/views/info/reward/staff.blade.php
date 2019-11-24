@extends('common.layouts')

@section('content')

    @include('common.message')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">{{ $name }} - 具体职工</div>
        <div style="margin: 10px;">
            <div class="col-lg-1 pull-right" style="margin-right: 20px;">
                <a href="{{ url('api/reward/staff/add', array('id' => $id)) }}">
                    <button type="button" class="btn btn-primary" style="width: 100px;height: 45px">编辑</button>
                </a>
            </div>
        </div>
        <table class="table table-hover" style="font-size: 16px;">
            <thead>
            <tr>
                <th><a name="sort" href="{{ url('api/info/index') }}">职工号</a></th>
                <th>真实姓名</th>
            </tr>
            </thead>
            <tbody>
            @foreach($info as $information)
                <tr>
                    <th scope="row">{{ $information->id }}</th>
                    <td>{{ $information->truename }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div align="center">
    <a href="{{ url('api/reward') }}">
        <button type="button" class="btn btn-primary" style="width:100px;height:45px;">返回</button>
    </a>
    </div>
@stop
