<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorprojectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctorprojects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('order_id');
            $table->string('name');
            $table->string('last');
            $table->string('email');
            $table->string('projectlogo');
            $table->string('projectimages');
            $table->bigInteger('phone');
            $table->string('profession');
            $table->string('project_url');
            $table->string('name_url');
            $table->integer('appointment_price');
            $table->longText('my_about');
            $table->bigInteger('safe_price')->default(0);

            $table->timestamp('doctor_startdate');
            $table->timestamp('doctor_enddate');
            $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('doctorprojects');
    }
}
