<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\Place;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $now = now();
        $target = $request->input('target');

        $competitionsQuery = Competition::query();

        if ($target === 'current') {
            // 現在開催中の大会を取得
            $competitionsQuery->where('start_at', '<=', $now)->where('close_at', '>=', $now);
        } elseif ($target === 'future') {
            // 近日開催予定の大会を取得
            $competitionsQuery->where('start_at', '>', $now);
        } elseif ($target === 'past') {
            // 過去に開催された大会を取得
            $competitionsQuery->where('close_at', '<', $now);
        }

        $currentCompetitions = $competitionsQuery->get();

        return view('competitions.competitions', compact('currentCompetitions', 'target'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $places = Place::all();

        return view('competitions.create', compact('places'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //バリデーションルール
        $rules = [
            'name' => 'required',
            'place' => 'required',
            'start_at' => 'required',
            'close_at' => 'required',
            'image_path' => 'sometimes|image'
        ];

        $validatedData = $request->validate($rules);


        //データベースの保存処理
        $competition = new Competition();
        $competition->name = $validatedData['name'];
        //$competition->name = $request->input('name');


        // プレースを選択した場合、その選択をもとに Place モデルからデータを取得
        //$selectedPlaceId = $request->input('place');
        $selectedPlaceId = $validatedData['name'];
        $selectedPlace = Place::find($selectedPlaceId);

        // Place モデルから取得したデータを設定
        if ($selectedPlace) {
            $competition->place_id = $selectedPlace->id;
            $competition->name = $selectedPlace->name;
        }

        // $competition->start_at = $request->input('start_at');
        // $competition->close_at = $request->input('close_at');
        $competition->start_at = $validatedData['start_at'];
        $competition->close_at = $validatedData['close_at'];


        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images');
        } else {
            $imagePath = 'default_image_path.jpg';
        }

        $competition->image_path = $imagePath;
        $competition->save();

        return redirect()->route('competitions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition)
    {
        return to_view('competitions.show', compact('competition'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function edit(Competition $competition)
    {
        return view('competitions.edit', compact('competition'));
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

        return to_route('competitions.competitions');
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

        return to_route('competitions.competitions');
        //「大会詳細」show.blade.phpにて削除できるようにする
    }

    // public function future() {
    //     //近日開催予定の大会を取得
    //     $now = now();
    //     $futureCompetitions = Competition::where('start_at', '>', $now)->get();

    //     return view('competitions.future', compact('futureCompetitions'));
    // }

    // public function past() {
    //     //過去に開催された大会を取得
    //     $now = now();
    //     $pastCompetitions = Competition::where('close_at', '<', $now)->get();

    //     return view('competitions.past', compact('pastCompetitions'));
    // }
}
