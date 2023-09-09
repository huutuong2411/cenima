<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('showtime', function (Blueprint $table) {
            $table->id();
            $table->integer('id_room');
            $table->integer('id_movie');
            $table->time('start_at');
            $table->time('end_at');
            $table->date('date');
            $table->integer('price');
            $table->integer('user_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('showtime', function (Blueprint $table) {
            Schema::dropIfExists('showtime');
        });
    }
};
