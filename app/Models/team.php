<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    //選手テーブルとのリレーション(一つのチームに複数人の選手が所属する)
    public function players() {
        return $this->hasMany(Player::class);
    }
}
