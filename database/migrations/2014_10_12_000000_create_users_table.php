<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('profil')->nullable()->default('profil.png');
            $table->string('name');
            $table->string('last');
            $table->text('verification_code');
            $table->string('email')->unique();
            $table->bigInteger('phone')->unique()->nullable();
            $table->string('password')->nullable();
            $table->boolean('is_verify')->default(0);
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
        Schema::dropIfExists('users');
    }
}
