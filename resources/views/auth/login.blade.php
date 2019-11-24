@extends('layouts.app')

@section('content')
<div class="container" align="center">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">登录</div>
                <br>
                <div class="panel-body" align="center">
                    {{--<a href="{{ url('api/info/detail', ['id' => $information->id]) }}">详情</a>&nbsp;--}}
                    <form class="form-horizontal" method="POST" action="">
                        {{--{{ route('login') }}--}}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('staff[username]') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">用户名</label>

                            <div class="col-md-6">
                                <input id="staff[username]" type="text" class="form-control" style="width: 250px;" name="staff[username]" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('staff[password]') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input id="staff[password]" type="password" class="form-control" style="width: 250px;" name="staff[password]" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-10" style="margin-left: 240px">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" style="zoom: 150%;" name="remember">记住我
                                    </label>
                                    <a class="btn btn-link" href="{{ url('forget/index', ['is_admin' => $is_admin]) }}" style="font-size: 18px; margin-left: 10px;">
                                        忘记密码？
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if (isset($error))
                            <div class="form-group">
                            <span class="help-block" style="font-size: 18px; color: red;">
                                <strong>{{ $error }}</strong>
                            </span>
                            </div>
                        @endif

                        <div class="form-group" align="center">
                                <button type="submit" style="width: 120px; height: 45px;font-size: 18px" class="btn btn-primary">
                                    登录
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
