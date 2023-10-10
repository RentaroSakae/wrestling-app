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

class OrganizerGameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $games = Game::with('competition', 'style', 'competitionClass', 'mat')->get();
        $competitions = Competition::find($id);
        // $styles = Style::all();
        // $competitionClasses = CompetitionClass::all();
        // $mats = Mat::where('competition_id', $competitions->id)->get();
        $players = Player::all();

        return view('organizer.games.index', compact('games', 'competitions', 'players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $competitions = Competition::find($id);
        $styles = Style::all();
        $competitionClasses = CompetitionClass::all();
        $mats = Mat::where('competition_id', $competitions->id)->get();
        $players = Player::all();

        return view('organizer.games.create', compact('styles', 'competitionClasses', 'mats', 'players', 'competitions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        $games = new Game();
        $games->competition_id = $id;
        $games->style_id = $request->input('style');
        $games->competition_class_id = $request->input('competition_class');
        $games->mat_id = $request->input('mat');
        $games->game_number = $request->input('game_number');
        $games->red_player_id = $request->input('red_player');
        $games->blue_player_id = $request->input('blue_player');
        $games->save();

        return redirect()->route('organizer.games.index', ['id' => $id]);
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
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}
