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
        Schema::create('scoresheets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('game_id');
            $table->integer('red_point')->default(0);
            $table->integer('blue_point')->default(0);
            $table->bigInteger('victory_player_id');
            $table->bigInteger('victory_type_id');
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
        Schema::dropIfExists('scoresheets');
    }
};
