<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\CategoriezedCompetition;
use App\Models\ClassfiedCompetition;
use App\Models\Competition;
use App\Models\CompetitionClass;
use Illuminate\Http\Request;

class OrganizerClassfiedCompetitionController extends Controller
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
    public function create(Competition $competition, CategoriezedCompetition $categoriezedCompetition)
    {

        $competitionClasses = CompetitionClass::all();

        return view('organizer.classfiedCompetitions.create', compact('competition', 'categoriezedCompetition', 'competitionClasses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Competition $competition, CategoriezedCompetition $categoriezedCompetition)
    {
        // TODO バリデーション作成
        $classfiedCompetition = new ClassfiedCompetition();
        $classfiedCompetition->categoriezed_competitions_id = $categoriezedCompetition->id;
        $classfiedCompetition->competition_class_id = $request->input('competition_class');
        $classfiedCompetition->save();

        return redirect()->route('organizer.competitions.show', ['competition' => $competition->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassfiedCompetition  $classfiedCompetition
     * @return \Illuminate\Http\Response
     */
    public function show(ClassfiedCompetition $classfiedCompetition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassfiedCompetition  $classfiedCompetition
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassfiedCompetition $classfiedCompetition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassfiedCompetition  $classfiedCompetition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassfiedCompetition $classfiedCompetition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassfiedCompetition  $classfiedCompetition
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassfiedCompetition $classfiedCompetition)
    {
        //
    }
}
