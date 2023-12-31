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
        $players = ClassfiedCompetitionPlayer::where('classfied_competition_id', $classfiedCompetition->id)->get();

        return view('users.classfiedCompetitionPlayers.index', compact('competition', 'categoriezedCompetition', 'classfiedCompetition', 'categories', 'classes', 'players'));
        // $competition = Competition::find($competition_id);
        // $competitionPlayers = ClassfiedCompetitionPlayer::where('competition_id', $competition_id);
        // $competitionClasses = CompetitionClass::all();

        // $target = $request->input('target');

        // if ($target === 'freestyle') {
        //     $competitionPlayers->where(function ($query) {
        //         $query->where('style_id', 1)->orWhereNull('style_id');
        //     });

        //     $competitionClasses = $competitionClasses->where('style_id', 1)->values();
        // } elseif ($target === 'grecoroman') {
        //     $competitionPlayers->where(function ($query) {
        //         $query->where('style_id', 2)->orWhereNull('style_id');
        //     });
        //     $competitionClasses = $competitionClasses->where('style_id', 2)->values();
        // } elseif ($target === 'woman') {
        //     $competitionPlayers->where(function ($query) {
        //         $query->where('style_id', 3)->orWhereNull('style_id');
        //     });
        //     $competitionClasses = $competitionClasses->where('style_id', 3)->values();
        // } else {
        //     $competitionPlayers->where(function ($query) {
        //         $query->where('style_id', 1)->orWhereNull('style_id');
        //     });
        //     $competitionClasses = $competitionClasses->where('style_id', 1)->values();
        // }

        // $competitionPlayers = $competitionPlayers->get();

        // return view(
        //     'users.competition-players.index',
        //     ['competition_id' => $competition_id],
        //     compact('competition_id', 'target', 'competition', 'competitionPlayers', 'competitionClasses')
        // );
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
