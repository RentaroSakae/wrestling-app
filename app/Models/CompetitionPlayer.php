<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionPlayer extends Model
{
    use HasFactory;

    protected $table = 'competition_player';

    protected $fillable = [
        'competition_id',
        'player_id',
        'style_id',
        'competition_class_id',
    ];

    //大会テーブルとのリレーション設定
    public function competition() {
        return $this->belongsTo(Competition::class, 'competition_id', 'id');
    }

    //選手テーブルとのリレーション設定
    public function player() {
        return $this->belongsTo(Player::class, 'player_id', 'id');
    }

    //スタイルテーブルとのリレーション設定
    public function style() {
        return $this->belongsTo(Style::class, 'style_id', 'id');
    }

    //階級テーブルとのリレーション設定
    public function competitionClass() {
        return $this->belongsTo(CompetitionClass::class, 'competition_class_id', 'id');
    }

}
