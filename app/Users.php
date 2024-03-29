<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use Notifiable;

    //定义性别常量
    const SEX_BOY = 10;     //男
    const SEX_GIRL = 20;    //女

    // 普通用户类
    protected $table='user';

    protected $fillable = [
        'staff_id',
        'username',
        'password',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    // 与职工类一对一关联
    public function staff()
    {
        return $this->belongsTo('App\Staff');
    }

    // 用于表单中性别的数据保持
    public function sex1($key = null )
    {
        $arr = [    //为常量赋值
            self::SEX_BOY => '男',
            self::SEX_GIRL => '女',
        ];

        if ($key !== null) {    //判断用户是否传参,有则根据传参的值返回对应的常量,没有则返回整个数组
            return array_key_exists($key, $arr) ? $arr[$key] : $arr[self::SEX_BOY];
        }

        return $arr;

    }
}
