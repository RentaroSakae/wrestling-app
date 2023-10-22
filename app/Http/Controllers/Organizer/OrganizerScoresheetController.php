<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;

use App\Models\Scoresheet;
use App\Models\Competition;
use App\Models\Game;
use App\Models\Mat;
use App\Models\Player;
use App\Models\Team;
use App\Models\Style;
use App\Models\VictoryType;
use Illuminate\Http\Request;

class OrganizerScoresheetController extends Controller
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
    public function create($competition_id, $game_id)
    {
        $competition = Competition::find($competition_id);
        $game = Game::find($game_id);
        $date = now()->format("Y-m-d H:i:s");
        $victory_types = VictoryType::all();

        return view('organizer.scoresheets.create',[
            'competition_id' => $competition_id,
            'game_id' => $game_id,
            'date' => $date,
            'game' => $game,
            'competition' => $competition,
            'victory_types' => $victory_types,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $competition_id, $game_id)
    {

        $scoresheets = new Scoresheet();
        $scoresheets->red_point = $request->input('red_score');
        $scoresheets->blue_point = $request->input('blue_score');
        $scoresheets->victory_player_id = $request->input('victory_player');
        $scoresheets->victory_type_id = $request->input('victory_type');
        $scoresheets->save();

        return redirect()->route('organizer.games.index', ['competition_id' => $competition_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score, $competition_id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Score $score)
    {
        $competition = Competition::find($competition_id);
        $styles = Style::all();
        $competitionClasses = CompetitionClass::all();
        $mats = Mat::where('competition_id', $competition->id)->get();
        $players = Player::all();

        return view('organizer.games.create', compact('styles', 'competitionClasses', 'mats', 'players', 'competition'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        //
    }
}
