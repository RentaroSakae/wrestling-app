<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    //competition_categoryテーブルとのリレーション
    public function category() {
        return $this->belongsTo(Category::class);
    }

    //Placeテーブルとのリレーション
     public function place() {
          return $this->belongsTo(Place::class);
     }

    //matsテーブルとのリレーション（1つの大会に複数のマットが存在する）
    public function mats() {
        return $this->hasMany(Mat::class);
    }

    //試合テーブルとのリレーション設定（一つの大会で複数の試合が行われる）
    public function games() {
        return $this->hasMany(Game::class);
    }


}
