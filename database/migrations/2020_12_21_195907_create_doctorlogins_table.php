<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorloginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctorlogins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unique();
            $table->bigInteger('tc');
            $table->string('name');
            $table->string('last');
            $table->string('email');
            $table->string('password');
            $table->string('profil');
            $table->string('title');
            $table->bigInteger('phone');
            $table->boolean('is_active')->default(0);
            $table->boolean('is_money')->default(0);
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
        Schema::dropIfExists('doctorlogins');
    }
}
