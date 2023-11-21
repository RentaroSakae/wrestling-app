<?php

namespace App\Http\Controllers\Organizer;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Competition;
use App\Models\CompetitionStyleClass;
use App\Models\CompetitionClass;
use App\Models\Style;

class OrganizerCompetitionStyleClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Competition $competition)
    {

        $categories = Category::all();
        $styles = Style::all();
        $competitionClasses = CompetitionClass::all();

        return view('organizer.competitionStyleClasses.create',  compact('competition', 'categories', 'styles', 'competitionClasses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Competition $competition)
    {
        // TODO バリデーション

        $competitionStyleClass = new CompetitionStyleClass();
        // $competitionStyleClass->category_id = $request->input('category');
        $competitionStyleClass->competition_id = $competition->id;
        $competitionStyleClass->competition_class_id = $request->input('competitionClass');
        $competitionStyleClass->save();

        return redirect()->route('organizer.competitions.show', ['competition' => $competition->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
