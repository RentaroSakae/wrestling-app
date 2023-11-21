<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionStyleClass extends Model
{
    use HasFactory;

    protected $table = 'competition_style_classes';

    // このモデルで扱う属性
    protected $fillable = ['category_id', 'competition_id', 'competition_class_id'];

    // Category モデルとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Competition モデルとのリレーション
    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }

    // CompetitionClass モデルとのリレーション
    public function competitionClass()
    {
        return $this->belongsTo(CompetitionClass::class, 'competition_class_id');
    }
}
