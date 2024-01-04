<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Game extends Model
{
    use HasFactory;

    //階級テーブルとのリレーション設定(一つの試合は一つの階級の中で行われる)
    public function competition_class()
    {
        return $this->belongsTo(CompetitionClass::class);
    }

    //マットテーブルとのリレーション設定(一つの試合は一つのマットで行われる)
    public function mat()
    {
        return $this->belongsTo(Mat::class, 'competition_id', 'competition_id');
    }

    //選手テーブルとのリレーション設定(一つの試合は複数の選手で行われる)
    public function red_player()
    {
        return $this->belongsTo(Player::class, 'red_player_id');
    }

    public function blue_player()
    {
        return $this->belongsTo(Player::class, 'blue_player_id');
    }

    //スタイルテーブルとのリレーション設定（一つの試合は一つのスタイルで行われる）
    public function style()
    {
        return $this->belongsTo(Style::class);
    }

    //大会テーブルとのリレーション設定（一つの試合は一つの大会で行われる）
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    //スコアシートテーブルとのリレーション（一つの試合に一つのスコアシートが存在する）
    public function scoresheet()
    {
        return $this->hasOne(Scoresheet::class);
    }

    //勝因テーブルとのリレーション（一つの試合に一つの勝因がある）
    public function victory_type()
    {
        return $this->belongsTo(VictoryType::class);
    }

    //回戦テーブルとのリレーション（一つの試合は一つのラウンドで行われる）
    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function next_games()
    {
        return $this->hasMany(Game::class, 'next_game_id');
    }

    public function competitionSchedule()
    {
        return $this->belongsToThrough(CompetitionSchedule::class, Round::class);
    }

    public function getCurrentGameNumberAttribute()
    {

        if (!$this->round || !$this->round->competitionSchedule) {
            return null; // または適切なデフォルト値を返す
        }

        $matId = $this->round->competitionSchedule->mat_id;

        $roundsBefore = Round::whereHas('competitionSchedule', function ($query) use ($matId) {
            $query->where('mat_id', $matId);
        })->where('id', '>', $this->round_id)->get();



        $gameCount = 0;
        foreach ($roundsBefore as $round) {
            $gameCount += $round->games->count();
        }

        // 現在のラウンド内でのゲームの順番も加算
        $gameCount += $this->round->games->where('id', '<=', $this->id)->count();

        return $gameCount;
    }
}
