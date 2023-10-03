<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionClass extends Model
{
    use HasFactory;

    //Styleテーブルとのリレーション
    public function styles() {
        return $this->belongsTo(Style::class);
    }

    //試合テーブルとのリレーション(一つの階級に複数の試合が存在する)
    public function games() {
        return $this->hasMany(game::class);
    }
}
