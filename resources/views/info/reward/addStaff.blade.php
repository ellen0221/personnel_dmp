@extends('common.layouts')

@section('style')
    <link rel="stylesheet" href="{{ asset('plugin/multiple-select-develop/dist/multiple-select.css') }}">
    <script type="text/javascript" src="{{ asset('plugin/multiple-select-develop/dist/multiple-select.js') }}"></script>
@stop

@section('content')

    @include('common.message')
    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">{{ $name }} - 添加职工</div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="{{ url('api/reward/staff/add', array('id' => $id)) }}">

                {{ csrf_field() }}

                <div class="form-group">
                <label for="staff_id" class="col-sm-2 control-lable" style="font-size: 20px;"><font class="alarm">*</font>职工:</label>
                </div>

                <div class="form-group">

                    <div style="width: 80%; margin-left: 150px">
                        @foreach( $staff as $v )
                            <label style="width:185px;overflow:auto;display:inline-block;cursor: pointer; font-size: 18px">
                                <input type="checkbox" name="staff[]" value="{{ $v->id }}" class="ml10" style="margin-top: -2px; zoom: 160%;"
                                       @if(in_array($v->id, $staff_ids))
                                        checked="checked"
                                       @else
                                       @endif
                                >{{ $v->truename }}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" style="width:100px;height:40px;">提交</button>
                        <a href="{{ url('api/reward/staff', ['id' => $id]) }}">
                            <button type="button" class="btn btn-primary" style="width:100px;height:40px;">返回</button>
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <script>
        $(function () {
            $("select[name='diag_id']").multipleSelect({
                addTitle: true, //鼠标点悬停在下拉框时是否显示被选中的值
                selectAll: false, //是否显示全部复选框，默认显示
                name: "职工",
                selectAllText: "选择全部", //选择全部的复选框的text值
                allSelected: "全部", //全部选中后显示的值
                //delimiter: ', ', //多个值直接的间隔符，默认是逗号
                placeholder: "请选择职工" //不选择时下拉框显示的内容
            });
        });
    </script>

@stop