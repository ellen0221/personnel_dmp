<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        if (!Auth::check()) {
            return redirect('/');
        }
    }

    public function returnMsg($code='200', $message='ok', $data='')
    {
        $result['status_code'] = $code;
        $result['message'] = $message;
        $result['data'] = $data;
        return $result;
    }

    public function message($is_admin, $url='', $status=1, $message='', $seconds=2)
    {
        return view('common.msg', [
            'is_admin' => $is_admin,
            'url' => $url ? $url : $_SERVER['HTTP_REFERER'],
            'status' => $status,    //1-成功 0-失败
            'message' => $message ? $message : ($status ? '操作成功...^-^' : '操作失败...orn'),
            'seconds' => $seconds,
        ]);
    }

}
