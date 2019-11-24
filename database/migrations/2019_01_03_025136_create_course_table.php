<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 课程信息表
        Schema::create('course_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->notnull()->comment('名称');
            $table->string('teacher')->nullable()->comment('授课人');
            $table->string('introduction')->nullable()->comment('简介');
            $table->string('book')->nullable()->comment('教材');
            $table->date('start_time')->nullable()->comment('开始时间');
            $table->date('end_time')->nullable()->comment('结束时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_info');
    }
}
