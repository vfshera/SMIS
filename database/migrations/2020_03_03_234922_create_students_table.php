<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('s_id');
            $table->string('admission');
            $table->string('name');
            $table->string('parents_fname');
            $table->string('parents_sname');
            $table->string('parents_tel');
            $table->bigInteger('class_id');
            $table->string('address');
            $table->string('town');
            $table->string('county');
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
        Schema::dropIfExists('students');
    }
}
