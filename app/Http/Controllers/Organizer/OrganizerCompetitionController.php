<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Mat;
use App\Models\Category;
use App\Models\Game;
use App\Models\Player;
use App\Models\CompetitionClass;
use App\Models\Style;
use App\Models\Team;


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
        $categories = Category::all();
        $competitions = $this->competitionsQuery->get();

        return view('organizer.competitions.create', compact('places', 'categories', 'competitions'));
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
            'image_path' => 'required',
            'category' => 'required'
        ]);

        $competition = new Competition();
        $competition->name = $request->input('name');
        $competition->start_at = $request->input('start_at');
        $competition->close_at = $request->input('close_at');
        $competition->place_id = $request->input('place');
        $competition->image_path = $request->input('image_path');
        $competition->category_id = $request->input('category');
        $competition->save();

        return redirect()->route('organizer.competitions.mats.create', ['id' => $competition->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition)
    {


        return view('organizer.competitions.show', compact('competition'));
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

    public function matsCreate($id) {
        $competitions = Competition::find($id);

        return view('organizer.mats.create', compact('competitions'));
    }

    public function matsStore(Request $request) {
        $mat = new Mat();
        $mat->name = $request->input('name');
        $mat->competition_id = $request->input('competition_id');
        $mat->save();

        $competitions = $request->input('competition_id');
        return redirect()->route('organizer.games.create', ['id' => $competitions]);
    }

}
