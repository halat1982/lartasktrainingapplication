<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'tasks',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('project_id');
                $table->foreign('project_id')->references('id')->on('projects');
                $table->string('reg_num')->unique()->collation("utf8_general_ci")->charset('utf8');
                $table->string('title')->collation("utf8_general_ci")->charset('utf8');
                $table->text('description')->collation("utf8_general_ci")->charset('utf8');
                $table->date('start_date')->nullable();
                $table->date('finish_date')->nullable();
                $table->integer('rate_time')->unsigned();
                $table->unsignedBigInteger('status');
                $table->foreign('status')->references('id')->on('task_statuses');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
