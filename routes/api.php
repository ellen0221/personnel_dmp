<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['web']], function () {

    // 管理员

    // 职工
    Route::any('info/index', 'StaffController@index');
    Route::any('info/create', 'StaffController@create');
    Route::any('info/update/{id}', 'StaffController@update');
    Route::any('info/detail/{id}', 'StaffController@detail');
    Route::any('info/delete/{id}', 'StaffController@delete');
    Route::any('info/setadmin/{id}', 'StaffController@setadmin');
    Route::any('info/salary/{id?}', 'StaffController@getSalary');
    Route::any('info/salary/add/{staff_id?}', 'StaffController@salary');
//    Route::post('info/salary/add', 'StaffController@salary');
    Route::any('info/admin', 'StaffController@admin');
    Route::any('info/canceladmin/{id}', 'StaffController@canceladmin');

    // 奖惩分类查看
    Route::any('info/allreward', 'RewardController@allreward');
    Route::any('info/allpunish', 'RewardController@allpunish');

    // 工资
    Route::any('salary', 'SalaryController@index');
    Route::any('salary/create', 'SalaryController@salary');

    // 部门
    Route::any('department', 'DepartmentController@index');
    Route::any('department/create', 'DepartmentController@create');
    Route::any('department/update', 'DepartmentController@update');
    Route::get('department/update/{id}', 'DepartmentController@update');
    Route::any('department/detail/{id}', 'DepartmentController@detail');
    Route::any('department/delete/{id}', 'DepartmentController@delete');

    // 岗位
    Route::any('post', 'PostController@index');
    Route::any('post/create', 'PostController@create');
    Route::any('post/update/{id}', 'PostController@update');
    Route::any('post/update/{id}', 'PostController@update');
    Route::any('post/delete/{id}', 'PostController@delete');

    // 培训课程
    Route::any('course', 'CourseController@index');
    Route::any('course/create', 'CourseController@create');
    Route::any('course/detail/{id}', 'CourseController@detail');
    Route::any('course/grade/{id}', 'CourseController@up_grade');
    Route::any('course/grade', 'CourseController@grade');
    Route::any('course/update/{id}', 'CourseController@update');
    Route::any('course/delete/{id}', 'CourseController@delete');

    // 奖惩
    Route::any('reward', 'RewardController@index');
    Route::any('reward/create', 'RewardController@create');
    Route::any('reward/update/{id}', 'RewardController@update');
    Route::any('reward/staff/{id?}', 'RewardController@staff');
    Route::any('reward/staff/add/{id}', 'RewardController@staffAdd');
    Route::any('reward/delete/{id}', 'RewardController@delete');



    // 普通职工
    Route::any('staff/index', 'UserController@index');      // 信息查看
    Route::any('staff/reset', 'UserController@reset');      // 密码重置
    Route::any('staff/edit', 'UserController@edit');    // 信息修改
    Route::any('staff/salary', 'UserController@salary');    // 工资查看
    Route::any('staff/reward', 'UserController@reward');    // 奖惩查看
    Route::any('staff/record', 'UserController@record');    // 选课记录
    Route::any('staff/course', 'UserController@course');    // 选课记录
    Route::any('staff/selected/{id}', 'UserController@selected');   // 选课

});




