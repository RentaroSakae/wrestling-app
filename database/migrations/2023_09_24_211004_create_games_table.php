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
            $table->integer('game_number');
            // $table->foreignId('mat_id')->constrained()->cascadeOnDelete();
            // $table->foreignId('red_player_id')->constrained()->cascadeOnDelete();
            $table->integer('red_score');
            // $table->foreignId('blue_player_id')->constrained()->cascadeOnDelete();
            $table->integer('blue_score');
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
        $table->dropForeign(['mat_id', 'red_player_id', 'blue_player_id']);
        $table->dropColumn(['game_number', 'mat_id', 'red_player_id', 'red_score', 'blue_player_id', 'blue_score']);
    }
};
