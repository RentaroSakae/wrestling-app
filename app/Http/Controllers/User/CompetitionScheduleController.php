<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Competition;
use App\Models\CompetitionSchedule;
use App\Models\Mat;
use Illuminate\Http\Request;

class CompetitionScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Competition $competition, Mat $mat)
    {
        $mats = Mat::whereHas('competitionSchedules', function ($query) use ($competition) {
            $query->where('competition_id', $competition->id);
        })->get();

        $schedules = CompetitionSchedule::where('mat_id', $mat->id)
            ->with('round.games', 'mat')
            ->orderBy('order', 'asc')
            ->get()
            ->groupBy(function ($item) {
                return $item->date . ' ' . $item->mat->name;
            });

        return view('users.competitionSchedules.index', compact('competition', 'mat', 'mats', 'schedules'));
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
