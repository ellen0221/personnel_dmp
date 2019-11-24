@if($is_admin)
    @extends('common.layouts')
@else
    @extends('common.stafflayouts')
@endif
@section('style')
    <meta HTTP-EQUIV="pragma" CONTENT="no-cache">
    <meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
    <meta HTTP-EQUIV="expires" CONTENT="0">
@stop
@section('content')

    <div class="panel panel-default" style="height: 100%;">
        <h2 style="padding-top: 20px; margin-left: 30px;">{{ $message }}</h2>
        <br>
        <h4 style="margin-left: 30px;">页面将在&nbsp;<b id="second">{{ $seconds }}</b>&nbsp;秒后&nbsp;<a id="url" href="{{ $url }}">跳转</a></h4>
    </div>
    <script>
        $(function () {
            $.ajaxSetup({cache:false});
            var second = document.getElementById("second");
            var url = $("#url").attr('href');
            var interval = setInterval(function () {
                var time = --second.innerHTML;
                if (time <= 0) {
                    location.href = url;
                    clearInterval(interval);
                }
            }, 1000);
        });
    </script>
@stop