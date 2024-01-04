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
use DateTime;

class OrganizerCompetitionScheduleController extends Controller
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
        return view('organizer.schedules.index', compact('competition', 'mat', 'mats', 'schedules', 'dateRange', 'targetDate'));
    }

    // マット別試合順ページ作成
    public function matchOrderIndex(Request $request, Competition $competition, Mat $mat)
    {

        $targetDate = $request->query('targetDate');
        $targetMat = $request->query('targetMat', $mat->id);

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

        return view('organizer.matchOrder.index', compact('competition', 'mat', 'mats', 'schedules', 'dateRange'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Competition $competition, Round $round)
    {
        $mats = Mat::where('competition_id', $round->classfiedCompetition->categoriezed_competition->competition->id)->get();

        return view('organizer.schedules.create', compact('competition', 'mats', 'round'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Competition $competition, Round $round)
    {
        $competitionSchedule = new CompetitionSchedule();
        $competitionSchedule->mat_id = $request->input('mat_id');
        $competitionSchedule->order = $request->input('order');
        $competitionSchedule->round_id = $round->id;
        $competitionSchedule->date = $request->input('date');
        $competitionSchedule->save();

        $mat = Mat::find($request->input('mat_id'));

        return redirect()->route('organizer.schedules.index', ['competition' => $competition->id, 'mat' => $mat]);
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
