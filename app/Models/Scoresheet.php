<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scoresheet extends Model
{
    use HasFactory;

    //試合テーブルとのリレーション（一人の得点は一つの試合に入る）
    public function game() {
        return $this->belongsTo(Game::class);
    }

    //選手テーブルとのリレーション（一つの得点は一人に入る）
    public function playser() {
        return $this->belongsTo(Player::class);
    }

    protected $fillable = ['game_id', 'red_point', 'blue_point', 'victory_type_id', 'victory_player_id'];

}
