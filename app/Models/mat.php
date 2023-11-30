<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mat extends Model
{
    use HasFactory;

    //試合テーブルとのリレーション設定(一つのマットで複数の試合が行われる)
    public function games()
    {
        return $this->hasMany(Game::class);
    }

    //大会会場テーブルとのリレーション設定（一つのマットは一つの大会会場にある）
    // public function places() {
    //     return $this->belongsTo(Place::class);
    // }

    //大会テーブルとのリレーション設定(一つのマットで一つの大会が開催される)
    public function competitions()
    {
        return $this->belongsTo(Competition::class);
    }

    //大会スケジュールテーブルとのリレーション
    public function competitionSchedule()
    {
        return $this->belongsTo(CompetitionSchedule::class);
    }
}
