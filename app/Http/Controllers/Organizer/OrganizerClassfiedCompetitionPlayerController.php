<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\ClassfiedCompetition;
use App\Models\ClassfiedCompetitionPlayer;
use App\Models\Player;
use Illuminate\Http\Request;

class OrganizerClassfiedCompetitionPlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClassfiedCompetition $classfiedCompetition)
    {
        $classfiedCompetitionPlayers = ClassfiedCompetitionPlayer::where('classfied_competition_id', $classfiedCompetition->id)->get();

        return view('organizer.classfiedCompetitionPlayers.index', compact('classfiedCompetition', 'classfiedCompetitionPlayers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ClassfiedCompetition $classfiedCompetition)
    {
        $players = Player::all();

        return view('organizer.classfiedCompetitionPlayers.create', compact('players', 'classfiedCompetition'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ClassfiedCompetition $classfiedCompetition)
    {
        $classfiedCompetitionPlayer = new ClassfiedCompetitionPlayer();
        $classfiedCompetitionPlayer->classfied_competition_id = $classfiedCompetition->id;
        $classfiedCompetitionPlayer->player_id = $request->input('player');
        $classfiedCompetitionPlayer->save();

        return redirect()->route('organizer.competitions.show', ['competition' => $classfiedCompetition->categoriezed_competition->competition->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassfiedCompetitionPlayer  $classfiedCompetitionPlayer
     * @return \Illuminate\Http\Response
     */
    public function show(ClassfiedCompetitionPlayer $classfiedCompetitionPlayer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassfiedCompetitionPlayer  $classfiedCompetitionPlayer
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassfiedCompetitionPlayer $classfiedCompetitionPlayer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassfiedCompetitionPlayer  $classfiedCompetitionPlayer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassfiedCompetitionPlayer $classfiedCompetitionPlayer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassfiedCompetitionPlayer  $classfiedCompetitionPlayer
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassfiedCompetitionPlayer $classfiedCompetitionPlayer)
    {
        //
    }
}
