<form class="form-horizontal" method="post" action="{{ url('api/post/create') }}">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="name" class="col-sm-2 control-lable">岗位名称<font style="color: red;">*</font></label>

        <div class="col-sm-5">
            <input type="text" name="Info[id]" hidden value="{{ $info ? $info->id : '' }}">
            <input type="text" name="Info[name]"
                   value="{{ $info ? $info->name : '' }}"
                   class="form-control" id="name" placeholder="请输入岗位名称" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-lable">所属部门<font style="color: red;">*</font></label>

        <div class="col-sm-5">
            <select name="Info[department_id]" required style="width: 220px;">
                <option value="">请选择部门</option>
                @foreach($dep as $v)
                    <option value="{{ $v->id }}" {{ $info && $v->id == $info->department_id ? 'selected' : '' }}>{{ $v->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="introduction" class="col-sm-2 control-lable">岗位简介</label>

        <div class="col-sm-5">
            <input type="text" name="Info[introduction]"
                   value="{{ $info ? $info->introduction : '' }}"
                   class="form-control" id="introduction" placeholder="请输入岗位简介" >
        </div>
    </div>
    <div class="form-group">
        <label for="level" class="col-sm-2 control-lable">岗位等级</label>
        <div class="col-sm-5">
            <input type="text" name="Info[level]"
                   value="{{ $info ? $info->level : '' }}"
                   class="form-control" id="level" placeholder="请输入岗位等级">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" style="width:100px;height:40px;">提交</button>
            <a href="{{ url('api/post') }}">
                <button type="button" class="btn btn-primary" style="width:100px;height:40px;">返回</button>
            </a>
        </div>
    </div>

</form>