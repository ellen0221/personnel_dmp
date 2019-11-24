@extends('common.layouts')

@section('content')

    {{--@include('common.validator')--}}

    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">【{{ $course_name }}】 {{ $info->truename }}-成绩录入</div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="{{ url('api/course/grade') }}">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="id" class="col-sm-2 control-lable">职工号</label>
                    <div class="col-sm-5">
                        <label>{{ $info->staff_id }}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="id" class="col-sm-2 control-lable">姓名</label>
                    <div class="col-sm-5">
                        <label>{{ $info->truename }}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="grade" class="col-sm-2 control-lable">成绩<font class="alarm">*</font></label>
                    <div class="col-sm-5">
                        <input type="text" hidden name="Info[id]" value="{{ $info->id }}">
                        <input type="text" hidden name="Info[course_id]" value="{{ $info->course_id }}">
                        <input type="text" name="Info[grade]"
                               value="{{ $info->grade }}"
                               class="form-control" id="grade" placeholder="请输入成绩" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" style="width:100px;height:40px;">提交</button>
                        <a href="{{ url('api/course/detail', ['id' => $info->course_id]) }}">
                            <button type="button" class="btn btn-primary" style="width:100px;height:40px;">返回</button>
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>

@stop