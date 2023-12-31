<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Player extends Model
{
    use HasFactory, Favoriteable;

    //大会テーブルとのリレーション設定（中間テーブル）
    public function classfiedCompetitions()
    {
        return $this->belongsToMany(ClassfiedCompetition::class)->withTimestamps();
    }

    //試合テーブルとのリレーション設定(一人の選手は複数の試合に出場する)
    public function games()
    {
        return $this->hasMany(Game::class);
    }

    //選手の所属テーブルとのリレーション(一人の選手は一つチームに所属する)
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    //得点テーブルとのリレーション（一人の選手は複数の得点を持つ）
    public function scores()
    {
        return $this->hasMany(Scoresheet::class);
    }
}
