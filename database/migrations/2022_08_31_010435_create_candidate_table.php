<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate', function (Blueprint $table) {
            $table->increments('id');
            $table->string('candidate_name')->default('')->comment('候选人名称');
            $table->integer('candidate_age')->comment('候选人年龄');
            $table->tinyInteger('educational')->comment('个人学历');
            $table->integer('experience')->comment('工作经验');
            $table->float('price')->comment('期望薪资');
            $table->string('position')->default('')->comment('担任过职位');
            $table->string('company')->nullable()->comment('上家公司');
            $table->string('candidate_people_image')->default('')->comment('候选人图像');
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
        Schema::dropIfExists('candidate');
    }
}
