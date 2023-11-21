<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionClass extends Model
{
    use HasFactory;

    //Styleテーブルとのリレーション
    public function style()
    {
        return $this->belongsTo(Style::class);
    }

    //試合テーブルとのリレーション(一つの階級に複数の試合が存在する)
    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'competition_style_classes',
            'competition_class_id',
            'category_id'
        );
    }

    public function competitions()
    {
        return $this->belongsToMany(
            Competition::class,
            'competition_style_classes',
            'competition_class_id',
            'competition_id'
        );
    }
}
