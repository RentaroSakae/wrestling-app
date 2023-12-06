<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Jobs\SendRemindMail;
use App\Models\Scoresheet;
use App\Models\Competition;
use App\Models\CompetitionClass;
use App\Models\Game;
use App\Models\Mat;
use App\Models\Player;
use App\Models\Team;
use App\Models\Style;
use App\Models\User;
use App\Models\UserCompetitionPlayer;
use App\Models\VictoryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Monolog\Handler\SendGridHandler;

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
    public function create(Game $game)
    {

        // $competition = Competition::find($competition_id);
        // $game = Game::find($game_id);
        $scoresheet = Scoresheet::where('game_id', '=', $game->id)->first(); //データがなかった場合はNULLが返ってくる
        $date = now()->format("Y-m-d H:i:s");
        $victoryTypes = VictoryType::all();

        //TODO compactに書き換える
        return view('organizer.scoresheets.create', compact('game', 'scoresheet', 'date', 'victoryTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Game $game)
    {
        $request->validate([
            'red_point' => 'required|integer', // 赤コーナーの得点
            'blue_point' => 'required|integer', // 青コーナーの得点
            'victory_type_id' => 'required|integer', // 勝利の種類
            'victory_player_id' => [
                'required',
                'integer',
            ],
        ]);


        Scoresheet::updateOrCreate(
            ['game_id' => $game->id],
            [
                //'game_id'=>$game_id,
                'red_point' => $request->input('red_point'),
                'blue_point' => $request->input('blue_point'),
                'victory_type_id' => $request->input('victory_type_id'),
                'victory_player_id' => $request->input('victory_player_id'),
            ]
        );

        // $result = Artisan::call('command:sendmail');
        SendRemindMail::dispatch();

        return redirect()->route('organizer.rounds.index', ['classfiedCompetition' => $game->round->classfiedCompetition->id]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Scoresheet $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Scoresheet $score, $competition_id)
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
    // public function update(Request $request, Scoresheet $score)
    // {
    //     $competition = Competition::find($competition_id);
    //     $styles = Style::all();
    //     $competitionClasses = CompetitionClass::all();
    //     $mats = Mat::where('competition_id', $competition->id)->get();
    //     $players = Player::all();

    //     return view('organizer.games.create', compact('styles', 'competitionClasses', 'mats', 'players', 'competition'));
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scoresheet $score)
    {
        //
    }
}
