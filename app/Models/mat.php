<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mat extends Model
{
    use HasFactory;

    //試合テーブルとのリレーション設定(一つのマットで複数の試合が行われる)
    public function games() {
        return $this->hasMany(game::class);
    }

    //大会会場テーブルとのリレーション設定（一つのマットは一つの大会会場にある）
    public function places() {
        return $this->belongsTo(place::class);
    }
}