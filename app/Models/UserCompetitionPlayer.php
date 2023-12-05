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

    public function classfiedCompetitionPlayer()
    {
        return $this->belongsTo(ClassfiedCompetitionPlayer::class, 'classfied_competition_player_id');
    }

    public function competition()
    {
        // ここでのリレーションシップのパスは、あなたのデータベース設計に基づいて調整する必要があります。
        // 例えば、ClassfiedCompetitionPlayer -> ClassfiedCompetition -> CategoriezedCompetition -> Competition などのパスが考えられます。
        return $this->classfiedCompetitionPlayer->classfiedCompetition->categoriezedCompetition->competition;
    }
}
