<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\CategoriezedCompetition;
use App\Models\ClassfiedCompetition;
use App\Models\Competition;
use App\Models\CompetitionSchedule;
use App\Models\Mat;
use App\Models\Round;
use Illuminate\Http\Request;

class OrganizerCompetitionScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Competition $competition, Mat $mat)
    {
        $schedules = CompetitionSchedule::where('mat_id', $mat->id)
            ->with('round.games')
            ->orderBy('order', 'asc')
            ->get();

        return view('organizer.schedules.index', compact('competition', 'mat', 'schedules'));
    }

    // マット別試合順ページ作成
    public function matchOrderIndex(Competition $competition, Mat $mat)
    {
        $schedules = CompetitionSchedule::where('mat_id', $mat->id)
            ->with('round.games.red_player', 'round.games.blue_player')
            ->get();

        $totalGamesBefore = 0;
        foreach ($schedules as $schedule) {
            $schedule->totalGamesBefore = $totalGamesBefore;
            $totalGamesBefore += $schedule->round->games->count();
        }

        return view('organizer.matchOrder.index', compact('competition', 'mat', 'schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Round $round)
    {
        $mats = Mat::where('competition_id', $round->classfiedCompetition->categoriezed_competition->competition->id)->get();

        return view('organizer.schedules.create', compact('mats', 'round'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Round $round)
    {
        $competitionSchedule = new CompetitionSchedule();
        $competitionSchedule->mat_id = $request->input('mat_id');
        $competitionSchedule->order = $request->input('order');
        $competitionSchedule->round_id = $round->id;
        $competitionSchedule->date = $request->input('date');
        $competitionSchedule->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompetitionSchedule  $competitionSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(CompetitionSchedule $competitionSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompetitionSchedule  $competitionSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(CompetitionSchedule $competitionSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompetitionSchedule  $competitionSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompetitionSchedule $competitionSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompetitionSchedule  $competitionSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompetitionSchedule $competitionSchedule)
    {
        //
    }
}
