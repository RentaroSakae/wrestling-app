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
            $table->bigInteger('competition_id')->nullable()->unsigned();
            $table->bigInteger('style_id');
            $table->bigInteger('competition_class_id');
            $table->bigInteger('mat_id');
            $table->bigInteger('round_id');
            $table->integer('game_number');
            $table->bigInteger('next_game_id')->nullable()->unsigned();
            $table->unsignedBigInteger('red_player_id');
            $table->unsignedBigInteger('blue_player_id');
            $table->bigInteger('scoresheet_id')->nullable()->unsigned();
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
