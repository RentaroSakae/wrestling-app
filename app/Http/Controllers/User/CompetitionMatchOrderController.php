<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CategoriezedCompetition;
use App\Models\Competition;
use App\Models\CompetitionSchedule;
use App\Models\Mat;
use Illuminate\Http\Request;
use DateTime;

class CompetitionMatchOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Competition $competition, Mat $mat)
    {
        $targetDate = $request->query('targetDate');
        $targetMat = $request->query('targetMat');

        $mats = Mat::whereHas('competitionSchedules', function ($query) use ($competition) {
            $query->where('competition_id', $competition->id);
        })->get();

        $query = CompetitionSchedule::query()
            ->with('round.games.red_player', 'round.games.blue_player');

        if ($targetDate) {
            $query->whereDate('date', $targetDate);
        }

        if ($targetMat) {
            $query->where('mat_id', $targetMat);
        } else {
            $query->where('mat_id', $mat->id);
        }

        $schedules = $query->get();

        // 試合番号の計算
        $totalGamesBefore = 0;
        foreach ($schedules as $schedule) {
            $gameCount = optional($schedule->round)->games ? $schedule->round->games->count() : 0;
            $schedule->totalGamesBefore = $totalGamesBefore;
            $totalGamesBefore += $gameCount;
        }

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

        // 大会スケジュール画面と同じようにdateとmatの最初の値を取得したい
        // URLの{competition}と$competition_idが同じmatを取得する
        $firstMat = $competition->mats()->first();

        $firstDaySchedule = CompetitionSchedule::where('mat_id', $firstMat->id)->orderBy('date')->first();

        // $targetDate と $targetMat のデフォルト値を設定
        if (!$targetDate && $firstDaySchedule) {
            $targetDate = $firstDaySchedule->date;
        }
        if (!$targetMat && $firstMat) {
            $targetMat = $firstMat->id;
        }

        // スケジュールクエリの更新
        $query = CompetitionSchedule::query()
            ->with('round.games.red_player', 'round.games.blue_player');

        if ($targetDate) {
            $query->whereDate('date', $targetDate);
        }
        if ($targetMat) {
            $query->where('mat_id', $targetMat);
        }

        $schedules = $query->get();


        $currentMat = $mat;

        return view('users.matchOrders.index', compact('competition', 'currentMat', 'mats', 'schedules', 'categoriezedCompetition', 'dateRange', 'targetDate', 'targetMat'));
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
