<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Staff;
use App\Users;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('staff');
    }

    public function authenticate(Request $request)
    {
        $login = $request->input('staff');
        if (Auth::attempt(array('username' => $login['username'], 'password' => $login['password']))) {
            // 认证通过...
            return redirect('api/info/index');
        } else {
            return redirect('login');
        }
    }

    public function staffauthenticate(Request $request)
    {
        $login = $request->input('staff');

        if (Auth::guard('staff')->attempt(['username' => $login['username'], 'password' => $login['password']]))
        {
            $id = DB::table('users')->where('username','=',$login['username'])->value('id');
            $info = Staff::find($id);
            return view('staff/index', [
                'info' => $info,
            ]);
        } else {
            return view('stafflogin');
        }
    }

}
