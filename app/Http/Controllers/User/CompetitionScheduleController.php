<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CategoriezedCompetition;
use App\Models\Competition;
use App\Models\CompetitionSchedule;
use App\Models\Mat;
use Illuminate\Http\Request;
use DateTime;

class CompetitionScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Competition $competition, Mat $mat)
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


        // 日付範囲を生成する関数
        function createDateRangeArray($startDate, $endDate)
        {
            $dates = [];
            $currentDate = new DateTime($startDate);
            $endDate = new DateTime($endDate);

            while ($currentDate <= $endDate) {
                $dates[] = $currentDate->format('Y-m-d');
                $currentDate->modify('+1 day');
            }

            return $dates;
        }

        // 例: CategoriezedCompetition の start_at と close_at を使って日付範囲を生成
        $categoriezedCompetitions = CategoriezedCompetition::where('competition_id', $competition->id)->get();
        $categoriezedCompetition = $categoriezedCompetitions->first();

        $dateRange = createDateRangeArray($categoriezedCompetition->start_at, $categoriezedCompetition->close_at);

        $targetDate = $request->input('target');


        $firstDaySchedule = CompetitionSchedule::where('mat_id', $mat->id)->orderBy('date')->first();

        if (!$targetDate) {
            $targetDate = $firstDaySchedule->date;
        }

        $currentMat = $mat;

        return view('users.competitionSchedules.index', compact('competition', 'currentMat', 'mats', 'schedules', 'categoriezedCompetition', 'dateRange', 'targetDate'));
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
