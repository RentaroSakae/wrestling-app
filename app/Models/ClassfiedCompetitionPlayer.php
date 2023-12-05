<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassfiedCompetitionPlayer extends Model
{
    use HasFactory;

    protected $table = 'classfied_competition_player';

    //階級別大会テーブルとのリレーション設定
    public function categoriezedCompetition()
    {
        return $this->belongsTo(CategoriezedCompetition::class, 'classfied_competition_id');
    }

    public function classfiedCompetition()
    {
        return $this->belongsTo(ClassfiedCompetition::class);
    }

    //選手テーブルとのリレーション設定
    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id', 'id');
    }

    //スタイルテーブルとのリレーション設定
    public function style()
    {
        return $this->belongsTo(Style::class, 'style_id', 'id');
    }

    //階級テーブルとのリレーション設定
    public function competitionClass()
    {
        return $this->belongsTo(CompetitionClass::class, 'competition_class_id', 'id');
    }

    //ユーザーテーブルとのリレーション設定
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    // roundテーブルとのリレーション
    public function rounds()
    {
        return $this->hasMany(Round::class);
    }
}
