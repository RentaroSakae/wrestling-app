<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;

    //Competition_Classテーブルとのリレーション
    public function classes() {
        return $this->hasMany(CompetitionClass::class);
    }

    //categoriesテーブルとのリレーション
    public function categories() {
        return $this->belongsToMany(Style::class)->withTimestamps();
    }
}
