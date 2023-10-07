<?php

namespace App\Http\Controllers\Organizer;

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
    public function index()
    {
        //マット別試合順ページ
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //【管理画面】試合作成ページ
        $style = Style::all();
        $competitionClass = CompetitionClass::all();
        $mat = Mat::all();
        $player = player::all();

        return view('organizer.competitions.games.create', compact('style', 'competitionClass', 'mat', 'player'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $game = new Game();
        $game->game_number = $request->input('game_number');
        $game->red_player = $request->input('red_player');
        $game->blue_player = $request->input('blue_player');
        $game->style = $request->input('style');
        $game->competitionClass = $request->input('competition_class');
        $game->mat = $request->input('mat');
        $game->save();

        return redirect()->route('competitions.mats');
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
