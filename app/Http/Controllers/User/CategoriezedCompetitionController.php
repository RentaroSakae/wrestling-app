<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\CategoriezedCompetition;
use App\Models\ClassfiedCompetition;
use App\Models\Competition;
use App\Models\CompetitionSchedule;
use App\Models\Mat;
use Illuminate\Http\Request;

class CategoriezedCompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Competition $competition, CategoriezedCompetition $categoriezedCompetition)
    {
        $classes = ClassfiedCompetition::where('categoriezed_competitions_id', $categoriezedCompetition->id)->get();
        $mats = Mat::where('competition_id', $competition->id)->get();
        $schedules = collect();

        // 各マットに対してスケジュールを取得
        foreach ($mats as $mat) {
            $matSchedules = CompetitionSchedule::where('mat_id', $mat->id)->get();
            // 各マットのスケジュールを全体のスケジュールコレクションに追加
            $schedules = $schedules->merge($matSchedules);
        }

        return view('users.categoriezedCompetitions.index', compact('competition', 'categoriezedCompetition', 'classes', 'schedules', 'mats'));
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
     * @param  \App\Models\CategoriezedCompetition  $categoriezedCompetition
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriezedCompetition $categoriezedCompetition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoriezedCompetition  $categoriezedCompetition
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriezedCompetition $categoriezedCompetition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoriezedCompetition  $categoriezedCompetition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriezedCompetition $categoriezedCompetition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoriezedCompetition  $categoriezedCompetition
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriezedCompetition $categoriezedCompetition)
    {
        //
    }
}
