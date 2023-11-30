<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionSchedule extends Model
{
    use HasFactory;

    //roundsテーブルとのリレーション
    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    //matsテーブルとのリレーション
    public function mat()
    {
        return $this->belongsTo(Mat::class);
    }
}
