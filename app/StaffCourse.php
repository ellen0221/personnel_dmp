<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffCourse extends Model
{
    // 课程类
    protected $table='staff_course';

    protected $fillable = [
        'staff_id',
        'course_id',
        'grade',
        'remark',
        'admin_id',
        'created_at',
    ];

    public $timestamps = false;

}
