<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            
            $table->string('country');
            
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')
                  ->references('id')
                  ->on('rooms')
                  ->onDelete('cascade');

            $table->Integer('acc_no');
            $table->date('from');
            $table->date('to');
            $table->unsignedBigInteger('price');
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
        Schema::dropIfExists('reservations');
    }
}
