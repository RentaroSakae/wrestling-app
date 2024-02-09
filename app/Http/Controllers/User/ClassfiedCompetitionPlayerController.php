<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CategoriezedCompetition;
use App\Models\ClassfiedCompetition;
use App\Models\ClassfiedCompetitionPlayer;
use Illuminate\Http\Request;
use App\Models\CompetitionPlayer;
use App\Models\Competition;
use App\Models\CompetitionClass;
use App\Models\Player;
use Illuminate\Support\Facades\Auth;

class ClassfiedCompetitionPlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Competition $competition, CategoriezedCompetition $categoriezedCompetition, ClassfiedCompetition $classfiedCompetition)
    {
        $categories = CategoriezedCompetition::where('competition_id', $competition->id)->get();
        $classes = ClassfiedCompetition::where('categoriezed_competitions_id', $categoriezedCompetition->id)->get();

        $players = ClassfiedCompetitionPlayer::where('classfied_competition_id', $classfiedCompetition->id)->with('player.team', 'favoriters')->get();

        return view('users.classfiedCompetitionPlayers.index', compact('competition', 'categoriezedCompetition', 'classfiedCompetition', 'categories', 'classes', 'players'));
    }

    public function favorite($playerId)
    {

        $player = ClassfiedCompetitionPlayer::find($playerId);
        if (!$player) {
            // エラーメッセージを追加
            return back()->withErrors(['message' => 'プレイヤーが見つかりません。']);
        }

        Auth::user()->togglefavorite($player);
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompetitionPlayer  $competitionPlayer
     * @return \Illuminate\Http\Response
     */
    public function show(CompetitionPlayer $competitionPlayer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompetitionPlayer  $competitionPlayer
     * @return \Illuminate\Http\Response
     */
    public function edit(CompetitionPlayer $competitionPlayer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompetitionPlayer  $competitionPlayer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompetitionPlayer $competitionPlayer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompetitionPlayer  $competitionPlayer
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompetitionPlayer $competitionPlayer)
    {
        //
    }
}
