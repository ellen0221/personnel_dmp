<form class="form-horizontal" method="post" action="{{ url('api/course/create') }}">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="name" class="col-sm-2 control-lable">课程名称<font style="color: red;">*</font></label>

        <div class="col-sm-5">
            <input type="text" name="Info[id]" hidden value="{{ $info ? $info->id : '' }}">
            <input type="text" name="Info[name]"
                   value="{{ $info ? $info->name : '' }}"
                   class="form-control" id="name" placeholder="请输入课程名称" required>
        </div>
    </div>
    <div class="form-group">
        <label for="introduction" class="col-sm-2 control-lable">课程简介</label>

        <div class="col-sm-5">
            <input type="text" name="Info[introduction]"
                   value="{{ $info ? $info->introduction : '' }}"
                   class="form-control" id="introduction" placeholder="请输入课程简介">
        </div>
    </div>
    <div class="form-group">
        <label for="teacher" class="col-sm-2 control-lable">授课人</label>

        <div class="col-sm-5">
            <input type="text" name="Info[teacher]"
                   value="{{ $info ? $info->teacher : '' }}"
                   class="form-control" id="teacher" placeholder="请输入授课人">
        </div>
    </div>
    <div class="form-group">
        <label for="book" class="col-sm-2 control-lable">教材</label>
        <div class="col-sm-5">
            <input type="text" name="Info[book]"
                   value="{{ $info ? $info->book : '' }}"
                   class="form-control" id="book" placeholder="请输入教材名称">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-lable">开始时间<font class="alarm">*</font></label>

        <div class="col-sm-5">
            <input type="text" name="Info[start_time]"
                   value="{{ $info ? $info->start_time : '' }}"
                   style="height: 33px; width: 220px;"
                   class="Wdate" id="start_time" onclick="WdatePicker({dateFmt: 'yyyy-MM-dd', minDate: '%y-%M-%d', readonly: true})" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-lable">结束时间<font class="alarm">*</font></label>

        <div class="col-sm-5">
            <input type="text" name="Info[end_time]"
                   value="{{ $info ? $info->end_time : '' }}"
                   style="height: 33px; width: 220px;"
                   class="Wdate" onclick="WdatePicker({dateFmt: 'yyyy-MM-dd',minDate:'#F{$dp.$D(\'start_time\',{d:0})}', readonly: true})" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" style="width:100px;height:40px;">提交</button>
            <a href="{{ url('api/course') }}">
                <button type="button" class="btn btn-primary" style="width:100px;height:40px;">返回</button>
            </a>
        </div>
    </div>

</form>