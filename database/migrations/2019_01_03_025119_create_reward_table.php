<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 奖惩信息表
        Schema::create('reward_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->notnull()->comment('名称');
            $table->string('description')->nullable()->comment('简介');
            $table->Integer('money')->notnull()->comment('金额');
            $table->tinyInteger('type')->default(1)->comment('奖惩类型 1-奖励 2-惩罚');
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
        Schema::dropIfExists('reward_info');
    }
}
