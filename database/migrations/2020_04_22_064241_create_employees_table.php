<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'employees',
            function (Blueprint $table) {
                $table->id();
                $table->string('reg_num')->unique()->collation("utf8_general_ci")->charset('utf8');
                $table->string('last_name')->collation("utf8_general_ci")->charset('utf8');
                $table->string('first_name')->collation("utf8_general_ci")->charset('utf8')->nullable();
                $table->string('second_name')->collation("utf8_general_ci")->charset('utf8')->nullable();
                $table->unsignedBigInteger('position');
                $table->foreign('position')->references('id')->on('positions');
                $table->date('birthday_date');
                $table->string('email')->unique()->collation("utf8_general_ci")->charset('utf8');
                $table->string('phone')->collation("utf8_general_ci")->charset('utf8');
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
        Schema::dropIfExists('employees');
    }
}
