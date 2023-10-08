<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;

    //Competition_Classテーブルとのリレーション
    public function competitionClasses() {
        return $this->hasMany(CompetitionClass::class);
    }

    //categoriesテーブルとのリレーション
    public function categories() {
        return $this->belongsToMany(Style::class)->withTimestamps();
    }

    //試合テーブルとのリレーション設定（一つのスタイルで複数の試合が行われる）
    public function games() {
        return $this->hasMany(Game::class);
    }
}
