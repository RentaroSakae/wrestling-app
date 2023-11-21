<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Mat;
use App\Models\Category;
use App\Models\CompetitionStyleClass;
use App\Models\Game;
use App\Models\Player;
use App\Models\CompetitionClass;
use App\Models\Style;
use App\Models\Team;
use App\Models\CompetitionPlayer;


class OrganizerCompetitionController extends Controller
{

    private $competitionsQuery;

    public function __construct()
    {
        $this->competitionsQuery = Competition::query();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $today = now()->format("Y-m-d H:i:s");
        $target = $request->input('target');

        $competitionsQuery = Competition::query()->with('place', 'category');

        if ($target === 'current') {
            // 現在開催中の大会を取得
            $competitionsQuery->where('start_at', '<=', $today)->where('close_at', '>=', $today);
        } elseif ($target === 'future') {
            // 近日開催予定の大会を取得
            $competitionsQuery->where('start_at', '>', $today);
        } elseif ($target === 'past') {
            // 過去に開催された大会を取得
            $competitionsQuery->where('close_at', '<', $today);
        } else {
            ///competitionsは現在開催中の大会を取得する
            $competitionsQuery->where('start_at', '<=', $today)->where('close_at', '>=', $today);
        }

        $currentCompetitions = $competitionsQuery->get();


        return view('organizer.competitions.index', compact('currentCompetitions', 'target'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $places = Place::all();
        // $categories = Category::all();
        $competitions = $this->competitionsQuery->get();

        return view('organizer.competitions.create', compact('places', 'competitions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO バリデーション作る

        $validated = $request->validate([
            'name' => 'required',
            'start_at' => 'required',
            'close_at' => 'required',
            'place' => 'required',
        ]);

        $competition = new Competition();
        $competition->name = $request->input('name');
        $competition->start_at = $request->input('start_at');
        $competition->close_at = $request->input('close_at');
        $competition->place_id = $request->input('place');
        $competition->save();

        return redirect()->route('organizer.competitions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition)
    {
        $mats = Mat::where('competition_id', $competition->id)->get();
        $styleClasses = CompetitionStyleClass::where('competition_id', $competition->id)->get();


        return view('organizer.competitions.show', compact('competition', 'mats', 'styleClasses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function edit(Competition $competition)
    {
        return view('organizer.competitions.edit', compact('competition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition $competition)
    {
        $competition->name = $request->input('name');
        $competition->place = $request->select('place');
        $competition->start_at = $request->input('start_at');
        $competition->close_at = $request->input('close_at');
        $competition->image_path = $request->image('image_path');
        $competition->update();

        return to_route('organizer.competitions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        $competition->delete();

        return to_route('organizer.competitions.index');
        //「大会詳細」show.blade.phpにて削除できるようにする
    }

    public function matsCreate($competition_id)
    {
        $competition = Competition::find($competition_id);

        return view('organizer.mats.create', compact('competition'));
    }

    public function matsStore(Request $request, $competition_id)
    {
        $mat = new Mat();
        $mat->name = $request->input('name');
        $mat->competition_id = $competition_id;
        $mat->save();

        // $competitions = $request->input('competition_id');
        return redirect()->route('organizer.competitions.show', ['competition' => $competition_id]);
    }

    public function matsEdit(Competition $competition, Mat $mat)
    {
        return view('organizer.mats.edit', compact('competition', 'mat'));
    }

    public function matsUpdate(Request $request, Competition $competition, Mat $mat)
    {

        $mat->name = $request->input('name');
        $mat->competition_id = $competition->id;
        $mat->update();

        return redirect()->route('organizer.competitions.show', ['competition' => $competition->id]);
    }

    public function matsDestroy(Competition $competition, Mat $mat)
    {
        $mat->delete();

        return redirect()->route('organizer.competitions.show', ['competition' => $competition->id, 'mat' => $mat->id]);
    }

    public function createPlayer($competition_id)
    {

        $competition = Competition::find($competition_id);
        $players = Player::all();
        $styles = Style::all();
        $competitionClasses = CompetitionClass::all();
        // スタイルや階級などの情報も取得することができます
        // スタイルや階級の情報が別テーブルにある場合は、関連モデルを利用します

        return view('organizer.competitions.create-player', compact('competition', 'players', 'styles', 'competitionClasses'));
    }

    public function storePlayer(Request $request, $competition_id)
    {

        $competition = Competition::find($competition_id);
        $playerId = $request->input('player_id');
        $styleId = $request->input('style_id');
        $competitionClassId = $request->input('competition_class_id');

        $competitionPlayer = new CompetitionPlayer();
        $competitionPlayer->competition_id = $competition_id;
        $competitionPlayer->player_id = $playerId;
        $competitionPlayer->style_id = $styleId;
        $competitionPlayer->competition_class_id = $competitionClassId;
        $competitionPlayer->save();

        return redirect()->route('organizer.competitions.show', ['id' => $competition_id]);
    }

    public function indexPlayer(Request $request, $competition_id)
    {
        $competition = Competition::find($competition_id);
        $competitionPlayers = CompetitionPlayer::where('competition_id', $competition_id);
        $competitionClasses = CompetitionClass::all();

        $target = $request->input('target');

        if ($target === 'freestyle') {
            $competitionPlayers->where(function ($query) {
                $query->where('style_id', 1)->orWhereNull('style_id');
            });

            $competitionClasses = $competitionClasses->where('style_id', 1)->values();
        } elseif ($target === 'grecoroman') {
            $competitionPlayers->where(function ($query) {
                $query->where('style_id', 2)->orWhereNull('style_id');
            });
            $competitionClasses = $competitionClasses->where('style_id', 2)->values();
        } elseif ($target === 'woman') {
            $competitionPlayers->where(function ($query) {
                $query->where('style_id', 3)->orWhereNull('style_id');
            });
            $competitionClasses = $competitionClasses->where('style_id', 3)->values();
        } else {
            $competitionPlayers->where(function ($query) {
                $query->where('style_id', 1)->orWhereNull('style_id');
            });
            $competitionClasses = $competitionClasses->where('style_id', 1)->values();
        }

        $competitionPlayers = $competitionPlayers->get();

        return view(
            'organizer.competitions.index-players',
            ['competition_id' => $competition_id],
            compact('competition_id', 'target', 'competition', 'competitionPlayers', 'competitionClasses')
        );
    }
}
