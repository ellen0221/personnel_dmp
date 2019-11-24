<form class="form-horizontal" method="post" action="{{ url('api/reward/create') }}">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="staff_id" class="col-sm-2 control-lable">项目名称<font class="alarm">*</font></label>

        <div class="col-sm-5">
            <input type="text" name="Info[id]" value="{{ $info ? $info->id : '' }}" hidden>
            <input type="text" name="Info[name]"
                   value="{{ $info ? $info->name : '' }}"
                   class="form-control" id="id" placeholder="请输入项目名称" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-lable">奖惩类型<font class="alarm">*</font></label>

        <div class="col-sm-5">
            <select name="Info[type]" style="height: 35px; width: 220px; border-radius: 4px;" required>
                <option value="">奖惩类型</option>
                <option value="1" {{ $info ? ($info->type == 1 ? 'selected' : '') : '' }}>奖励</option>
                <option value="2" {{ $info ? ($info->type == 2 ? 'selected' : '') : '' }}>惩罚</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="introduction" class="col-sm-2 control-lable">项目简介</label>

        <div class="col-sm-5">
            <input type="text" name="Info[description]"
                   value="{{ $info ? $info->description : '' }}"
                   class="form-control" id="description" placeholder="请输入项目简介">
        </div>
    </div>
    <div class="form-group">
        <label for="num" class="col-sm-2 control-lable">奖惩金额<font class="alarm">*</font></label>

        <div class="col-sm-5">
            <input type="text" name="Info[money]"
                   value="{{ $info ? $info->money : '' }}"
                   class="form-control" id="money" placeholder="请输入奖惩金额" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" style="width:100px;height:40px;">提交</button>
            <a href="{{ url('api/reward') }}">
                <button type="button" class="btn btn-primary" style="width:100px;height:40px;">返回</button>
            </a>
        </div>
    </div>

</form>