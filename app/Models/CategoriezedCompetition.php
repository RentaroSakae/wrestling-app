<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class CategoriezedCompetition extends Model
{
    use HasFactory, Favoriteable;

    //大会テーブルとのリレーション
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    //カテゴリテーブルとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    //階級別大会とのリレーション
    public function classfiedCompetitions()
    {
        return $this->hasMany(ClassfiedCompetition::class, 'categoriezed_competitions_id');
    }
}
