<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\CategoriezedCompetition;
use App\Models\ClassfiedCompetition;
use App\Models\Competition;
use App\Models\CompetitionSchedule;
use App\Models\Game;
use App\Models\Mat;
use App\Models\Scoresheet;
use Illuminate\Http\Request;

class ScoresheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Competition $competition, CategoriezedCompetition $categoriezedCompetition, ClassfiedCompetition $classfiedCompetition, Game $game)
    {
        //
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
     * @param  \App\Models\Scoresheet  $scoresheet
     * @return \Illuminate\Http\Response
     */
    public function show(Scoresheet $scoresheet, Competition $competition, CategoriezedCompetition $categoriezedCompetition, ClassfiedCompetition $classfiedCompetition, Game $game)
    {

        $game = Game::with('round.competitionSchedule')->find($game->id);
        $competitionSchedule = CompetitionSchedule::where('round_id', $game->round->id)->first();

        return view('users.scoresheets.show', compact('scoresheet', 'competition', 'categoriezedCompetition', 'classfiedCompetition', 'game', 'competitionSchedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scoresheet  $scoresheet
     * @return \Illuminate\Http\Response
     */
    public function edit(Scoresheet $scoresheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Scoresheet  $scoresheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scoresheet $scoresheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scoresheet  $scoresheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scoresheet $scoresheet)
    {
        //
    }
}
