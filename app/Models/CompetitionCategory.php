<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionCategory extends Model
{
    use HasFactory;

    //competitionテーブルとのリレーション
    public function competitions() {
        return $this->belongsTo(Competition::class);
    }

    //styleテーブルとのリレーション
    public function styles() {
        return $this->belongsToMany(Style::class)->withTimestamps();
    }
}
