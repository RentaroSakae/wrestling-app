<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    //試合テーブルとのリレーション設定(一人の選手は複数の試合に出場する)
    public function games() {
        return $this->hasMany(Game::class);
    }

    //選手の所属テーブルとのリレーション(一人の選手は一つチームに所属する)
    public function teams() {
        return $this->belongsTo(Team::class);
    }
}
