<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition_Class extends Model
{
    use HasFactory;

    //Styleテーブルとのリレーション
    public function styles() {
        return $this->belongsToMany(Style::class)->withTimestamps();
    }
}
