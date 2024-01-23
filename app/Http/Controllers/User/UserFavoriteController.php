<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserFavoriteController extends Controller
{
    public function store($classfiedCompetitionPlayer_id)
    {
        Auth::user()->favorite_classfiedCompetitionPlayers()->attach($classfiedCompetitionPlayer_id);

        return back();
    }

    public function destroy($classfiedCompetitionPlayer_id)
    {
        Auth::user()->favorite_classfiedCompetitionPlayers()->detach($classfiedCompetitionPlayer_id);

        return back();
    }
}
