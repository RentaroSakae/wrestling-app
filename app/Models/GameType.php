<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameType extends Model
{
    use HasFactory;

    // ラウンドテーブルとのリレーション
    public function rounds()
    {
        return $this->hasMany(Round::class);
    }
}
