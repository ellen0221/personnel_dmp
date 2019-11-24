<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Staff;
use App\Users;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgetController extends Controller
{
    // 忘记密码
    public function index($is_admin)
    {
        return view('auth.passwords.reset', [
            'is_admin' => $is_admin,
        ]);
    }

    public function forget(Request $request)
    {
        $username = $request->input('username');
        $email = $request->input('email');
        $is_admin = $request->input('is_admin');
        if ($is_admin) {
            $info = Admin::where('username', $username)->first();
            if (!$info) {
                return view('auth.passwords.reset', [
                    'is_admin' => $is_admin,
                    'error' => '未找到该用户，请检查用户名',
                ]);
            }
        } else {
            $info = Staff::where('username', $username)->first();
            if (!$info) {
                return view('auth.passwords.reset', [
                    'is_admin' => $is_admin,
                    'error' => '未找到该用户，请检查用户名',
                ]);
            }
        }
        $token = base64_encode($is_admin.'_'.$username);
        DB::table('forget')->insert([
            'username' => $username,
            'token' => $token,
            'is_admin' => $is_admin,
        ]);
        $url = url('forget/email/'.$token);
        $content = "请访问此链接重置密码：".$url;
        $toMail = $request->input('email');
        $send = Mail::raw($content, function ($message) use ($toMail) {
            $message->subject('人事信息管理系统--密码重置-'.date("Y-m-d H:i:s"));
            $message->to($toMail);
        });
        if (!$send) {
            return view('auth.passwords.reset', [
                'success' => '邮件已发送至您的邮箱，请及时查看',
            ]);
        } else {
            return view('auth.passwords.reset', [
                'error' => '操作失败',
            ]);
        }
    }

    public function reset($token)
    {
        $staff = DB::table('forget')->where('token', $token)->first();

        if ($staff) {
            return view('auth.reset', [
                'token' => $token,
            ]);
        } else {
            return view('auth.reset', [
                'error' => '链接已失效！',
            ]);
        }
    }

    public function set(Request $request)
    {
        $password = $request->input('password');
        $token = $request->input('token');
        $staff = DB::table('forget')->where('token', $token)->first();
//        var_dump($staff->username);
        $delete = DB::table('forget')->where('token', $token)->delete();
        if ($staff) {
            if ($staff->is_admin) {
                $res = Admin::where('username', $staff->username)->update(['password' => bcrypt($password)]);
            } else {
                $res = Users::where('username', $staff->username)->update(['password' => bcrypt($password)]);
            }
            if ($res) {
                return view('auth.reset', [
                    'id' => '',
                    'success' => '密码重置成功',
                ]);
            } else {
                return view('auth.reset', [
                    'id' => '',
                    'error' => '密码重置失败',
                ]);
            }
        } else {
            return view('auth.reset', [
                'id' => '',
                'error' => '链接失效！',
            ]);
        }
    }
}
