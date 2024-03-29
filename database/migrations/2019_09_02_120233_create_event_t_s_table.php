<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_t_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_name');
            $table->date('event_date');
            $table->time('event_time');
            $table->string('category');
            $table->integer('no_of_guests');
            $table->string('food_menu');
            $table->string('clients_menu');
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
        Schema::dropIfExists('event_t_s');
    }
}
