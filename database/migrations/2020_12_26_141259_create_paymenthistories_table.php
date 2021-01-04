<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymenthistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymenthistories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('doctor_id');
            $table->bigInteger('order_id');
            $table->string('name');
            $table->string('last');
            $table->string('email');
            $table->bigInteger('phone');
            $table->integer('appointment_price');
            $table->text('doctor_message')->nullable();
            $table->boolean('is_report')->default(0);
            $table->boolean('is_money')->default(0);
            $table->timestamp('doctor_date');
            $table->time('doctor_time');
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
        Schema::dropIfExists('paymenthistories');
    }
}
