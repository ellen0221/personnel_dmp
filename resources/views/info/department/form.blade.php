<form class="form-horizontal" method="post" action="{{ url('api/department/create') }}">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="name" class="col-sm-2 control-lable">部门名称<font style="color: red;">*</font></label>

        <div class="col-sm-5">
            <input type="text" name="Info[id]" hidden value="{{ $info ? $info->id : '' }}">
            <input type="text" name="Info[name]"
                   value="{{ $info ? $info->name : '' }}"
                   class="form-control" id="name" placeholder="请输入部门名称" required>
        </div>
    </div>
    <div class="form-group">
        <label for="function" class="col-sm-2 control-lable">部门简介</label>
        <div class="col-sm-5">
            <input type="text" name="Info[introduction]"
                   value="{{ $info ? $info->introduction : ''}}"
                   class="form-control" id="introduction" placeholder="请输入部门简介">
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" style="width:100px;height:40px;">提交</button>
            <a href="{{ url('api/department') }}">
                <button type="button" class="btn btn-primary" style="width:100px;height:40px;">返回</button>
            </a>
        </div>
    </div>

</form>