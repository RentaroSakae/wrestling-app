<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCompetitionPlayer extends Model
{
    use HasFactory;

    protected $table = 'user_competition_player';

    //
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function competitionPlayers()
    {
        return $this->belongsToMany(CompetitionPlayer::class)->withTimestamps();
    }
}
