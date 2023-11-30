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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('round_id');
            $table->integer('game_number');
            $table->unsignedBigInteger('red_player_id')->nullable()->unsigned();
            $table->unsignedBigInteger('blue_player_id')->nullable()->unsigned();
            $table->bigInteger('scoresheet_id')->nullable()->unsigned();
            $table->bigInteger('next_game_id')->nullable()->unsigned();
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
        Schema::dropIfExists('games');
    }
};
