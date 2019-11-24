<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // 课程类
    protected $table='course_info';

    protected $fillable = [
        'name',
        'teacher',
        'introduction',
        'book',
        'start_time',
        'end_time',
        'end_time',
        'created_at',
        'updated_at',
        'admin_id',
    ];

    public $timestamps = false;

    // 与职工类多对多
    public function staff()
    {
        $this->belongsToMany('App\Staff');
    }
}
