@extends('layouts.app')

@section('content')
@if(isset($token))
<div class="container" align="center">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">重置密码</div>
                <br>
                <div class="panel-body" align="center">
                    <form class="form-horizontal" method="POST" action="{{ url('forget/set') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-md-4 control-label">新密码</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="请输入新密码">
                                <input id="token" type="text" class="form-control" name="token" style="display: none;" value="{{ $token }}">
                            </div>
                        </div>

                            <div align="center">
                                <button type="submit" style="width: 100px" class="btn btn-primary">
                                    确认
                                </button>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@else
    @if (isset($error))
        <h2 align="center" style="padding-top: 200px; padding-bottom: 50px; color: red;">{{ $error }}</h2>
    @endif
    @if (isset($success))
        <h2 align="center" style="padding-top: 200px; padding-bottom: 50px;">{{ $success }}</h2>
    @endif
    <br>
    <h4 align="center">页面将在&nbsp;<b id="second">2</b>&nbsp;秒后&nbsp;<a id="url" href="{{ url('/') }}">返回首页</a></h4>
    <script>
        $(function () {
            $.ajaxSetup({cache:false});
            var second = document.getElementById("second");
            var url = $("#url").attr('href');
            console.log(url);
            var interval = setInterval(function () {
                var time = --second.innerHTML;
                if (time <= 0) {
                    location.href = url;
                    clearInterval(interval);
                }
            }, 1000);
        });
    </script>
@endif

@endsection
