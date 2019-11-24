<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffSalary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 职工工资表
        Schema::create('staff_salary', function (Blueprint $table) {
            $table->increments('id');
            $table->string('staff_id')->notnull()->comment('职工id');
            $table->string('salary_id')->notnull()->comment('工资id');
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
        Schema::dropIfExists('staff_salary');
    }
}
