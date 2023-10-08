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
            $table->foreign('competition_id')->references('id')->on('competitions')->OnDelete('cascade');
            $table->foreignId('style_id')->constrained()->cascadeOnDelete();
            $table->foreignId('competition_class_id')->constrained()->cascadeOnDelete();
            $table->foreignId('mat_id')->constrained()->cascadeOnDelete();
            $table->integer('game_number');
            $table->unsignedBigInteger('red_player_id');
            $table->foreign('red_player_id')->references('id')->on('players');
            $table->integer('red_score')->default(0);
            $table->unsignedBigInteger('blue_player_id');
            $table->foreign('blue_player_id')->references('id')->on('players');
            $table->integer('blue_score')->default(0);
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
        $table->dropForeign(['competition_id', 'mat_id', 'red_player_id', 'blue_player_id']);
        $table->dropColumn(['game_number', 'mat_id', 'red_player_id', 'red_score', 'blue_player_id', 'blue_score']);
    }
};
