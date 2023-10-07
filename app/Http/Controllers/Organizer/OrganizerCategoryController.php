<?php

namespace App\Http\Controllers\Organizer;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Competition;

class OrganizerCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('organizer.categories.create', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
     {
         $competitions = Competition::all();

         return view('organizer.categories.create', compact('competitions'));
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Competition $competition)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->competition_id = $competition->id;
        $category->save();

        return redirect()->route('organizer.competitions.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $coategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition $competition, Category $category)
    {
        $category->name = $request->input('name');
        $category->name = $request->input('name');
        $category->competition_id = $competition->id;
        $category->save();

        return redirect()->route('organizer.competitions.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition, Category $category)
    {
        $category->delete();

        return redirect()->route('organizer.competitions.create');
    }
}
