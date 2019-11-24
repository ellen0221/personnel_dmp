@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="padding: 0;">
            <div class="panel panel-default">
                <div class="panel-heading">忘记密码</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('forget/email') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="">

                        <div class="form-group">
                            <label for="username" class="col-md-4 control-label">用户名<font style="color: red;">*</font></label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" style="width: 300px;" name="username" required autofocus>
                                <input type="text" style="display: none;" name="is_admin" value="{{ isset($is_admin) ? $is_admin : '' }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">邮箱地址<font style="color: red;">*</font></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" style="width: 300px;" name="email" required>
                            </div>
                        </div>

                        <div class="form-group" align="center">
                            <div>
                                <button type="submit" class="btn btn-primary" style="width: 100px;">
                                    确定
                                </button>
                            </div>
                        </div>

                        @if (isset($error))
                            <div class="form-group" align="center">
                            <span class="help-block" style="font-size: 18px; color: red;">
                                <strong>{{ $error }}</strong>
                            </span>
                            </div>
                        @endif
                        @if (isset($success))
                            <div class="form-group" align="center">
                            <span class="help-block" style="font-size: 18px;">
                                <strong>{{ $success }}</strong>
                            </span>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
