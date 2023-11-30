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
        Schema::create('classfied_competition_player', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classfied_competition_id')->constrained()->cascadeOnDelete();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
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
        Schema::table('classfied_competition_player', function (Blueprint $table) {
            $table->dropForeign(['classfied_competition_id', 'player_id']);
            $table->dropColumn('classfied_competition_id', 'player_id');
        });
        Schema::dropIfExists('classfied_competition_player');
    }
};
