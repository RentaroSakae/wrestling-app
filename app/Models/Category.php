<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //competitionテーブルとのリレーション
    public function competitions() {
        return $this->hasMany(Competition::class);
    }

    //styleテーブルとのリレーション
    public function styles() {
        return $this->belongsToMany(Style::class)->withTimestamps();
    }
}
