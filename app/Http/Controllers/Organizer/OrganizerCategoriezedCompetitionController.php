<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;

use App\Models\CategoriezedCompetition;
use App\Models\Category;
use App\Models\Competition;
use Illuminate\Http\Request;

class OrganizerCategoriezedCompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Competition $competition)
    {
        $categories = Category::all();

        return view('organizer.categoriezedCompetitions.create', compact('competition', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Competition $competition)
    {
        // TODO バリデーション作成


        $categoriezedCompetition = new CategoriezedCompetition();
        $categoriezedCompetition->competition_id = $competition->id;
        $categoriezedCompetition->category_id = $request->input('category');
        $categoriezedCompetition->start_at = $request->input('start_at');
        $categoriezedCompetition->close_at = $request->input('close_at');
        $categoriezedCompetition->save();

        return redirect()->route('organizer.classfiedCompetitions.create', ['competition' => $competition->id, 'categoriezedCompetition' => $categoriezedCompetition->id]);
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
