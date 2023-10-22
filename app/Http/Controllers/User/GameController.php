<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Competition;
use App\Models\Mat;
use App\Models\Category;
use App\Models\Game;
use App\Models\Player;
use App\Models\CompetitionClass;
use App\Models\Style;

class GameController extends Controller
{
    public function index(Request $request, $competition_id)
    {

        $mat_id = $request->query('mat_id');
        $competition = Competition::find($competition_id);

        $gameQuery = Game::query()->with('red_player', 'blue_player', 'competition_class', 'style');
        $gameQuery->where('competition_id', '=', $competition_id);


        if(!empty($mat_id)) {
            $gameQuery->where('mat_id', '=', $mat_id);
        }

        $games = $gameQuery->get();
        $mats = Mat::where('competition_id', $competition->id)->get();

        return view('users.games.index', compact(['competition_id', 'mats', 'games', 'competition']));
    }
}
