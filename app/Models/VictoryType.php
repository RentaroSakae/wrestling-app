<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VictoryType extends Model
{
    use HasFactory;

    //試合テーブルとのリレーション（一つの勝因は複数の試合で使われる）
    public function games() {
        return $this->hasMany(Game::class);
    }
}
