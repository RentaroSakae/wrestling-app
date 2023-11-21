<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Competition extends Model
{
    use HasFactory, Favoriteable;

    //competition_categoryテーブルとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Placeテーブルとのリレーション
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    //matsテーブルとのリレーション（1つの大会に複数のマットが存在する）
    public function mats()
    {
        return $this->hasMany(Mat::class);
    }

    //試合テーブルとのリレーション設定（一つの大会で複数の試合が行われる）
    public function games()
    {
        return $this->hasMany(Game::class);
    }

    //選手テーブルとのリレーション設定（中間テーブル）
    public function players()
    {
        return $this->belongsToMany(Player::class)->withTimestamps();
    }

    public function competitionClasses()
    {
        return $this->belongsToMany(
            CompetitionClass::class,
            'competition_style_classes',
            'competition_id',
            'competition_class_id'
        );
    }
}
