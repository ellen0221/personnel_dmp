<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Admin
     */
    protected function create(array $data)
    {
        return Admin::create([
            'staff_id' => $data['staff_id'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function createstaff(array $data)
    {
        return Users::create([
            'staff_id' => $data['staff_id'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),    // 要用Auth验证，新建对象时密码只能用bcrypt加密
        ]);
    }
}
