<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassfiedCompetition extends Model
{
    use HasFactory;

    //カテゴリ別大会テーブルとのリレーション
    public function categoriezed_competition()
    {
        return $this->belongsTo(CategoriezedCompetition::class, 'categoriezed_competitions_id');
    }

    //階級テーブルとのリレーション
    public function competitionClass()
    {
        return $this->belongsTo(CompetitionClass::class, 'competition_class_id');
    }

    //ラウンドテーブルとのリレーション
    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

    // 階級別大会・選手テーブルとのリレーション
    public function classfied_competition_players()
    {
        return $this->belongsToMany(ClassfiedCompetition::class)->withTimestamps();
    }
}
