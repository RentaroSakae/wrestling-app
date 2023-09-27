<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;

    //Competision_Categoryテーブルとのリレーション
    public function competition_categories() {
        return $this->belongsToMany(CompetitionCategory::class)->withTimestamps();
    }

    //Competition_Classテーブルとのリレーション
    public function Competition_Classes() {
        return $this->belongsToMany(CompetitionClass::class)->withTimestamps();
    }
}
