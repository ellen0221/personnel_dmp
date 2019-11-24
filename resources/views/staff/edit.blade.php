@extends('common.stafflayouts')

@section('content')
    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">个人信息修改</div>
        <form action="/api/staff/edit" method="post">
        <table class="table table-bordered table-hover form">
            <tbody>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <tr>
                <th width="20%">职工号</th>
                <td>{{ $info->id }}</td>
            </tr>
            <tr>
                <th>姓名</th>
                <td>{{ $info->truename }}</td>
            </tr>
            <tr>
                <th>年龄</th>
                <td><input type="text" name="info[age]" value="{{ $info->age }}"></td>
            </tr>
            <tr>
                <th>性别</th>
                <td>
                    <select name="info[sex]" style="width: 172px; height: 30px;">
                        @if($info->sex == 1)
                            <option value="">请选择</option><option value="1" selected>男</option><option value="2">女</option>
                        @elseif($info->sex == 2)
                            <option value="">请选择</option><option value="1">男</option><option value="2" selected>女</option>
                        @else
                            <option value="">请选择</option><option value="1">男</option><option value="2">女</option>
                        @endif
                    </select>
                </td>
            </tr>
            <tr>
                <th>学历</th>
                <td><input type="text" name="info[education]" value="{{ $info->education }}"></td>
            </tr>
            <tr>
                <th>所属部门</th>
                <td>
                    @if(isset($data['department_name']))
                        {{ $data['department_name'] }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th>目前岗位</th>
                <td>
                    @if(isset($data['post_name']))
                        {{ $data['post_name'] }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <button type="submit"  style="width:100px;height:40px; margin-right: 50px;">确定修改</button>
                    <button type="button" id="back" data-html="{{ url('api/staff/index') }}" style="width:100px;height:40px;">返回</button>
                </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div>

@stop
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script>
    $(function () {
        $("#back").on('click', function () {
            window.location.href = $(this).data('html');
        });
    });
</script>