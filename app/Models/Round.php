<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    //階級別大会とのリレーション
    public function classfiedCompetition()
    {
        return $this->belongsTo(ClassfiedCompetition::class);
    }

    //ゲームタイプとのリレーション
    public function gameType()
    {
        return $this->belongsTo((GameType::class));
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function competitionSchedule()
    {
        return $this->hasOne(CompetitionSchedule::class);
    }
}
