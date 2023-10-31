<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;

use App\Models\Competition;
use App\Models\Game;
use Illuminate\Http\Request;
use App\Models\Style;
use App\Models\CompetitionClass;
use App\Models\Mat;
use App\Models\Player;
use App\Models\Team;
use App\Models\Round;
use App\Models\Scoresheet;

class OrganizerGameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($competition_id)
    {

        $competition = Competition::find($competition_id);
        $games = Game::where('competition_id', $competition->id)
            ->with(
                'competition',
                'style',
                'competition_class',
                'mat',
                'round'
                )->get();
        $players = Player::all();

        return view('organizer.games.index', compact('games', 'competition', 'players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($competition_id)
    {
        $competition = Competition::find($competition_id);
        $styles = Style::all();
        $competitionClasses = CompetitionClass::all();
        $mats = Mat::where('competition_id', $competition->id)->get();
        $players = Player::all();
        $rounds = Round::all();

        return view('organizer.games.create', compact('styles', 'competitionClasses', 'mats', 'players', 'competition', 'rounds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $competition_id)
    {
        $games = new Game();
        $games->competition_id = $competition_id;
        $games->style_id = $request->input('style');
        $games->competition_class_id = $request->input('competition_class');
        $games->mat_id = $request->input('mat');
        $games->round_id = $request->input('round_id');
        $games->game_number = $request->input('game_number');
        $games->red_player_id = $request->input('red_player');
        $games->blue_player_id = $request->input('blue_player');
        $games->save();

        $gameId = $games->id;

        $scoresheet = new Scoresheet();
        $scoresheet->game_id = $gameId;
        $scoresheet->red_point = 0;
        $scoresheet->blue_point = 0;
        $scoresheet->save();

        $games->scoresheet_id = $scoresheet->id;

        $games->save();

         return redirect()->route('organizer.games.index', ['competition_id' => $competition_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit($competition_id, $game_id)
    {
        $game = Game::find($game_id);
        $competition = Competition::find($competition_id);
        $styles = Style::all();
        $competitionClasses = CompetitionClass::all();
        $mats = Mat::where('competition_id', $game->competition_id)->get();
        $players = Player::all();
        return view('organizer.games.edit',['competition_id' => $competition_id, 'game_id' => $game_id],  compact('game', 'styles', 'competitionClasses', 'mats', 'players', 'competition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $competition_id, $game_id)
    {
        $game = Game::find($game_id);
        $game->style_id = $request->input('style');
        $game->competition_class_id = $request->input('competition_class');
        $game->mat_id = $request->input('mat');
        $game->game_number = $request->input('game_number');
        $game->red_player_id = $request->input('red_player');
        $game->blue_player_id = $request->input('blue_player');
        $game->update();

        return redirect()->route('organizer.games.index', ['competition_id' => $competition_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game, $competition_id, $game_id)
    {

        $game = Game::find($game_id);
        $game->delete();

        return redirect()->route('organizer.games.index', ['competition_id' => $competition_id]);
    }

}
