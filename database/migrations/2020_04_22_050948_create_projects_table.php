<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'projects',
            function (Blueprint $table) {
                $table->id();
                $table->string('reg_num')->unique()->collation("utf8_general_ci")->charset('utf8');
                $table->string('title')->collation("utf8_general_ci")->charset('utf8');
                $table->string('alias')->collation("utf8_general_ci")->charset('utf8')->nullable();
                $table->text('description')->collation("utf8_general_ci")->charset('utf8');
                $table->unsignedBigInteger('manager_id');
                $table->date('register_date');
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
        Schema::dropIfExists('projects');
    }
}

