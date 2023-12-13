<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemindHistory extends Model
{
    use HasFactory;

    // ユーザーテーブルとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 試合テーブルとのリレーション
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
