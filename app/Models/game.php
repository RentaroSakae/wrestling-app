<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    //階級テーブルとのリレーション設定(一つの試合は一つの階級の中で行われる)
    public function competitionClass() {
        return $this->belongsTo(CompetitionClass::class);
    }

    //マットテーブルとのリレーション設定(一つの試合は一つのマットで行われる)
    public function mats() {
        return $this->belongsTo(Mat::class);
    }

    //選手テーブルとのリレーション設定(一つの試合は複数の選手で行われる)
    public function players() {
        return $this->hasMany(Player::class);
    }

    //スタイルテーブルとのリレーション設定（一つの試合は一つのスタイルで行われる）
    public function style() {
        return $this->belongsTo(Style::class);
    }
}
