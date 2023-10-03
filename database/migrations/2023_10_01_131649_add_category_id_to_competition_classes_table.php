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
        Schema::table('competition_classes', function (Blueprint $table) {
            $table->bigInteger('style_id')->nullable()->unsigned()->after('id');
            $table->foreign('style_id')->references('id')->on('styles')->OnDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competition_classes', function (Blueprint $table) {
            //
        });
    }
};
