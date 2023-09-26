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
        Schema::table('games', function (Blueprint $table) {
            // // 赤コーナーの選手の外部キー制約
            // $table->foreign('red_player_id')->references('id')->on('players');

            // // 青コーナーの選手の外部キー制約
            // $table->foreign('blue_player_id')->after('red_score')->references('id')->on('players');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign(['red_player_id']);
            $table->dropForeign(['blue_player_id']);
        });
    }
};
