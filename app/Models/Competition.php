<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    //competition_categoryテーブルとのリレーション
    public function categories() {
        return $this->belongsTo(CompetitionCategory::class);
    }

    //Placeテーブルとのリレーション
    public function place() {
        return $this->belongsTo(Place::class);
    }
}
