<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // 岗位类
    protected $table = 'post_info';

    protected $fillable = [
        'name',
        'level',
        'department_id',
        'created_at',
        'updated_at',
    ];

    // 与职工类一对多
    public function staff()
    {
        return $this->hasMany('App\Staff','post_id','id');
    }

    // 与部门类多对多
    public function department()
    {
        return $this->belongsToMany('App\Department','department_post','post_id','department_id')->withPivot('num');
    }

}
