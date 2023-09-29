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
        Schema::table('competitions', function (Blueprint $table) {
            // $table->foreignId('category_id')->after('name')->constrained()->cascadeOnDelete();
            // カラム追加
            //TODO nullableを取る
            $table->bigInteger('category_id')->nullable()->unsigned()->after('name');
            // カラムの外部キー制約追加
            $table->foreign('category_id')->references('id')->on('categories')->OnDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competitions', function (Blueprint $table) {
            // 外部キー制約の削除
            $table->dropForeign('competitions_category_id_foreign');
            // カラムの削除
            $table->dropColumn('category_id');
        });
    }
};
