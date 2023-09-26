<?php

namespace App\Http\Controllers;

use App\Models\Competition_Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Competition;
use Illuminate\Support\Facades;

class Competition_CategoryController extends Controller
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
    public function store(Request $request, Competition $competition)
    {
        $competition_category = new Competition_Category();
        $competition_category->name = $request->input('name');
        $competition_category->competition_id = $competition->id;
        $competition_category->save();

        return redirect()->route('admin.competitions.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Competition_Category  $competition_Category
     * @return \Illuminate\Http\Response
     */
    public function show(Competition_Category $competition_Category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Competition_Category  $competition_Category
     * @return \Illuminate\Http\Response
     */
    public function edit(Competition_Category $competition_Category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Competition_Category  $competition_Category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition_Category $competition_Category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Competition_Category  $competition_Category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition_Category $competition_Category)
    {
        //
    }
}
