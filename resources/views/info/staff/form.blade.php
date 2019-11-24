<form id="addform" class="form-horizontal" method="POST" action="{{ url('/api/info/create') }}">

    {{ csrf_field() }}

    {{--@include('common.validator')--}}
    <label>{{ session()->get('error') }}</label>
    <div class="form-group">
        <label for="truename" class="col-sm-2 control-lable">真实姓名<font class="alarm">*</font></label>
        <div class="col-sm-2">
            <input type="text" name="Info[truename]"
                   value="{{ $info ? $info['truename'] : '' }}"
                   class="form-control" id="truename" placeholder="请输入真实姓名" required>
            @if($info)
            <input style="display: none;" type="text" name="Info[staff_id]" value="{{ $info ? $info->id : '' }}">
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="username" class="col-sm-2 control-lable">用户名<font class="alarm">*</font></label>
        <div class="col-sm-2">
            <input type="text" name="Info[username]"
                   value="{{ $info ? $info['username'] : '' }}"
                   {{ $info ? 'disabled' : '' }}
                   class="form-control" id="username" placeholder="请输入用户名" required>
        </div>
    </div>
    <div class="form-group">
        <label for="age" class="col-sm-2 control-lable">年龄</label>
        <div class="col-sm-2">
            <input type="text" name="Info[age]"
                   value="{{ $info ? $info['age'] : '' }}"
                   class="form-control" id="age" placeholder="请输入年龄">
        </div>
    </div>
    <div class="form-group">
        <label for="sex" class="col-sm-2 control-lable">性别</label>

        <div class="col-sm-2">
                <label class="radio-inline">
                    <input type="radio" name="Info[sex]" value="1" {{ $info && $info['sex'] == 1 ? 'checked' : '' }}> 男
                </label>
                <label class="radio-inline">
                    <input type="radio" name="Info[sex]" value="2" {{ $info && $info['sex'] == 2 ? 'checked' : '' }}> 女
                </label>
        </div>
    </div>
    <div class="form-group">
        <label for="education" class="col-sm-2 control-lable">学历</label>

        <div class="col-sm-2">
            <input type="text" name="Info[education]"
                   value="{{ $info ? $info['education'] : '' }}"
                   class="form-control" id="education" placeholder="请输入学历">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-lable">部门-岗位<font class="alarm">*</font></label>

        <div class="col-sm-2">
            <select name="Info[post_id]" style="width: 220px;height: 35px;" required>
                <option value="">请选择</option>
                @foreach($post as $p)
                    <option value="{{ $p->id }}" {{ $info && $info['post_id'] == $p->id ? 'selected' : '' }}>{{ $p->dep_name }}-{{ $p->post_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" style="width:100px;height:40px;">确定</button>
            <a href="{{ url('api/info/index') }}">
                <button type="button" class="btn btn-primary" style="width:100px;height:40px;">返回</button>
            </a>
        </div>
    </div>

</form>

