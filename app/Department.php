<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // 部门信息类
    protected $table = 'department_info';

    protected $fillable = [
        'name',
        'function',
        'created_at',
        'updated_at',
    ];

    // 与职工类一对多
    public function staff()
    {
        return $this->hasMany('App\Staff','department_id','id');
    }

    // 与岗位类一对多
    public function post()
    {
        return $this->hasMany('App\Post','department_id','id');
    }

}
