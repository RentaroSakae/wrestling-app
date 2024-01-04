<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\ClassfiedCompetition;
use App\Models\Competition;
use App\Models\Game;
use App\Models\GameType;
use App\Models\Round;
use App\Models\Scoresheet;
use Illuminate\Http\Request;

class OrganizerRoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClassfiedCompetition $classfiedCompetition)
    {
        $rounds = Round::where('classfied_competition_id', $classfiedCompetition->id)->get();
        $roundIds = $rounds->pluck('id');
        $games = Game::whereIn('round_id', $roundIds)->with('scoresheet')->get();

        return view('organizer.rounds.index', compact('classfiedCompetition', 'rounds', 'games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ClassfiedCompetition $classfiedCompetition)
    {

        $gameTypes = GameType::all();

        return view('organizer.rounds.create', compact('classfiedCompetition', 'gameTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ClassfiedCompetition $classfiedCompetition)
    {

        // show画面に戻る方法調べる
        // TODO バリデーション作成
        $round = new Round();
        $round->classfied_competition_id = $classfiedCompetition->id;
        $round->title = $request->input('title');
        $round->game_type_id = $request->input('game_type');
        $round->save();

        return redirect()->route('organizer.competitions.show', ['competition' => $classfiedCompetition->categoriezed_competition->competition->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function show(Round $round)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function edit(Round $round)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Round $round)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function destroy(Round $round)
    {
        $classfiedCompetitionId = $round->classfiedCompetition->id;

        $round->games()->delete();

        if ($round->competitionSchedule) {
            $round->competitionSchedule->delete();
        }

        $round->delete();

        return redirect()->route('organizer.rounds.index', ['classfiedCompetition' => $classfiedCompetitionId]);
    }
}
