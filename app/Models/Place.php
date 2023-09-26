<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    public function competitions() {
        //元々はbelongsTo
        return $this->hasMany(Competition::class);
    }

    //マットテーブルとのリレーション(一つの大会会場に複数のマットが存在する)
    public function mats() {
        return $this->hasMany(mat::class);
    }
}
