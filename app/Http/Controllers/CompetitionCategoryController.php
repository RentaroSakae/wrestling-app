<?php

namespace App\Http\Controllers;

use App\Models\CompetitionCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Competition;

class CompetitionCategoryController extends Controller
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

    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Competition $competition)
    {
        $competitionCategory = new CompetitionCategory();
        $competitionCategory->name = $request->input('name');
        $competitionCategory->competition_id = $competition->id;
        $competitionCategory->save();

        return redirect()->route('admin.competitions.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompetitionCategory  $competitionCategory
     * @return \Illuminate\Http\Response
     */
    public function show(CompetitionCategory $competitionCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompetitionCategory  $competitionCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(CompetitionCategory $competitionCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompetitionCategory  $competitionCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition $competition, CompetitionCategory $competitionCategory)
    {
        $competitionCategory->name = $request->input('name');
        $competitionCategory->name = $request->input('name');
        $competitionCategory->competition_id = $competition->id;
        $competitionCategory->save();

        return redirect()->route('admin.competitions.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompetitionCategory  $competitionCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition, CompetitionCategory $competitionCategory)
    {
        $competitionCategory->delete();

        return redirect()->route('admin.competitions.create');
    }
}
