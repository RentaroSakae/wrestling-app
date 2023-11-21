<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //competitionテーブルとのリレーション
    public function competitions()
    {
        return $this->hasMany(Competition::class);
    }

    //styleテーブルとのリレーション
    public function styles()
    {
        return $this->belongsToMany(Style::class)->withTimestamps();
    }

    public function competitionClasses()
    {
        return $this->belongsToMany(
            CompetitionClass::class,
            'competition_style_classes',
            'category_id',
            'competition_class_id'
        );
    }
}
