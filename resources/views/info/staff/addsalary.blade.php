@extends('common.layouts')

@section('content')

    {{--@include('common.validator')--}}
    @include('common.message')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">{{ $truename }} - 工资录入</div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="{{ url('api/info/salary/add', ['staff_id' => $id]) }}">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="basic" class="col-sm-2 control-lable">基本工资</label>
                    <div class="col-sm-5">
                        <input type="text" name="Info[staff_id]" value="{{ $id }}" style="display: none;">
                        <input type="text" name="Info[basic]"
                               class="form-control" id="basic" placeholder="请输入基本工资">
                    </div>
                </div>
                <div class="form-group">
                    <label for="level" class="col-sm-2 control-lable">级别工资</label>

                    <div class="col-sm-5">
                        <input type="text" name="Info[level]"
                               class="form-control" id="level" placeholder="请输入级别工资">
                    </div>
                </div>

                <div class="form-group">
                    <label for="fund" class="col-sm-2 control-lable">公积金</label>

                    <div class="col-sm-5">
                        <input type="text" name="Info[fund]"
                               class="form-control" id="fund" placeholder="请输入公积金">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-lable">时间</label>

                    <div class="col-sm-5">
                        <input type="text" name="Info[time]" style="height: 33px; width: 220px;"
                               class="Wdate" onclick="WdatePicker({dateFmt: 'yyyy-MM', minDate: '%y-%M', readonly: true})" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" style="width:100px;height:40px;">提交</button>
                        <a href="{{ url('api/info/salary', ['id' => $id]) }}">
                            <button type="button" class="btn btn-primary" style="width:100px;height:40px;">返回</button>
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>

@stop