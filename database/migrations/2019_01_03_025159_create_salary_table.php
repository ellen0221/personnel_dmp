<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 工资信息表
        Schema::create('salary_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staff_id')->notnull()->comment('职工id');
            $table->integer('basic')->nullable()->comment('基本工资');
            $table->integer('level')->nullable()->comment('级别工资');
            $table->integer('fund')->nullable()->comment('公积金');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_info');
    }
}
