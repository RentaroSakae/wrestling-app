<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    //試合テーブルとのリレーション（一つのラウンドで複数の試合行われる）
    public function games() {
        return $this->hasMany(Game::class);
    }
}
