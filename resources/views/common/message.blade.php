{{--<!-- 成功提示框 -->--}}
{{--@if(session()->has('success'))--}}
{{--<div class="alert alert-success alert-dismissable" role="alert" style="width: 100%">--}}
    {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
        {{--<span aria-hidden="true">&times;</span>--}}
    {{--</button>--}}
    {{--<strong>{{ session()->get('success') }}</strong>--}}
{{--</div>--}}
{{--@endif--}}

{{--<!-- 失败提示框 -->--}}
{{--@if(session('error'))--}}
{{--<div class="alert alert-danger alert-dismissable" role="alert" style="width: 100%">--}}
    {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
        {{--<span aria-hidden="true">&times;</span>--}}
    {{--</button>--}}
    {{--<strong>{{ session('error') }}</strong>--}}
{{--</div>--}}
{{--@endif--}}

<!-- 成功提示框 -->
{{--@if(isset($success))--}}
{{--<div class="alert alert-success alert-dismissable" role="alert" style="width: 100%; margin-bottom: 0;">--}}
    {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
        {{--<span aria-hidden="true">&times;</span>--}}
    {{--</button>--}}
    {{--<strong>{{ $success }}</strong>--}}
{{--</div>--}}
{{--@endif--}}
<!-- 成功提示框 -->
@if(!empty(session('success')))
<div class="alert alert-success alert-dismissable" role="alert" style="width: 100%; margin-bottom: 0;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{ session('success') }}</strong>
</div>
@endif

<!-- 失败提示框 -->
@if(isset($error))
<div class="alert alert-danger alert-dismissable" role="alert" style="width: 100%; margin-bottom: 0;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{ $error }}</strong>
</div>
@endif

