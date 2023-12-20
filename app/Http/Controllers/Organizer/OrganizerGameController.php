<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\ClassfiedCompetitionPlayer;
use App\Models\Competition;
use App\Models\Game;
use Illuminate\Http\Request;
use App\Models\Style;
use App\Models\CompetitionClass;
use App\Models\Mat;
use App\Models\Player;
use App\Models\Team;
use App\Models\Round;
use App\Models\Scoresheet;
use App\Models\CompetitionPlayer;

class OrganizerGameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($competition_id)
    {

        $competition = Competition::find($competition_id);
        $games = Game::query()
            ->with('red_player', 'blue_player', 'competition_class', 'style', 'round')
            ->whereHas('round.classfiedCompetition.categoriezed_competition', function ($query) use ($competition_id) {
                $query->where('competition_id', $competition_id);
            })
            ->get();
        $mats = Mat::where('competition_id', $competition->id)->get();
        $players = Player::all();

        return view('organizer.games.index', compact('games', 'competition', 'players'));
    }

    public function create(Competition $competition, Game $game, Round $round)
    {
        $players = ClassfiedCompetitionPlayer::where('classfied_competition_id', $round->classfiedCompetition->id);
        $classfiedCompetitionId = $round->classfiedCompetition->id;
        $roundIds = Round::where('classfied_competition_id', $classfiedCompetitionId)->pluck('id');
        $games = Game::whereIn('round_id', $roundIds)->get();

        return view('organizer.games.create', compact('round', 'players', 'games'));
    }

    public function store(Request $request, Round $round)
    {
        $game = new Game();
        $game->round_id = $round->id;
        $game->game_number = $request->input('game_number');
        $game->next_game_id = $request->input('next_game_id') ?: null;
        $game->red_player_id = $request->input('red_player');
        $game->blue_player_id = $request->input('blue_player');
        $game->save();

        $scoresheet = new ScoreSheet();
        $scoresheet->game_id = $game->id; // 作成したゲームの ID を設定
        $scoresheet->save(); // スコアシートを保存

        $game->scoresheet_id = $scoresheet->id;
        $game->save();

        return redirect()->route('organizer.rounds.index', ['classfiedCompetition' => $round->classfiedCompetition->id]);
    }

    public function edit(Game $game)
    {
        $players = ClassfiedCompetitionPlayer::where('classfied_competition_id', $game->round->classfiedCompetition->id)->get();
        $classfiedCompetitionId = $game->round->classfiedCompetition->id;

        // 他のゲームの中で、現在のゲームが次のゲームとして設定されているものを検索
        $nextGames = Game::where('next_game_id', $game->id)
            ->whereHas('round', function ($query) use ($classfiedCompetitionId) {
                $query->where('classfied_competition_id', $classfiedCompetitionId);
            })
            ->get();

        // 勝者のリストを取得
        $victoryPlayers = [];
        foreach ($nextGames as $nextGame) {
            if ($nextGame->scoresheet && $nextGame->scoresheet->victory_player) {
                $victoryPlayers[] = $nextGame->scoresheet->victory_player;
            }
        }

        $roundIds = Round::where('classfied_competition_id', $classfiedCompetitionId)->pluck('id');
        // $games = Game::whereIn('round_id', $roundIds)->get();

        $games = Game::whereIn('round_id', $roundIds)->get();
        $currentNextGameId = $game->next_game_id;

        return view('organizer.games.edit', compact('game', 'games',  'players', 'victoryPlayers', 'currentNextGameId', 'nextGames'));
    }

    public function update(Request $request, Game $game)
    {
        $game->round_id = $game->round->id;
        $game->game_number = $request->input('game_number');
        $game->next_game_id = $request->input('next_game_id') ?: null;
        $game->red_player_id = $request->input('red_player');
        $game->blue_player_id = $request->input('blue_player');
        $game->next_game_id = $request->input('next_game_id');
        $game->update();

        return redirect()->route('organizer.rounds.index', ['classfiedCompetition' => $game->round->classfiedCompetition->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function createLower($competition_id, $game_id)
    public function createLower(Competition $competition, Game $game, Round $round)
    {
        $allGames = Game::where('competition_id', $competition->id)
            ->with(
                'competition',
                'style',
                'competition_class',
                'mat',
                'round'
            )->get();

        //上位の試合を取得(「下位の試合を作成」ボタンをクリックした試合)
        $topGame = $game;

        //下位の試合を取得
        $lowGames = $allGames->where('next_game_id', $topGame->id);

        $styles = Style::find($topGame->style->id);
        $competitionClasses = CompetitionClass::find($topGame->competition_class_id);
        $mats = Mat::where('competition_id', $competition->id)->get();
        $players = Player::all();
        $rounds = Round::all();

        return view('organizer.games.create-lower', compact('topGame', 'lowGames', 'styles', 'competitionClasses', 'mats', 'players', 'competition', 'rounds'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeLower(Request $request, $competition_id, $game_id)
    {
        $game = new Game();
        $game->competition_id = $competition_id;

        $styleName = $request->input('style');
        $style = Style::where('name', $styleName)->first();
        $styleId = $style->id;
        $game->style_id = $styleId;

        $competitionClassClass = $request->input('competition_class');
        $competitionClass = CompetitionClass::where('class', $competitionClassClass)->first();
        $competitionClassId = $competitionClass->id;
        $game->competition_class_id = $competitionClassId;

        $game->mat_id = $request->input('mat');
        $game->round_id = $request->input('round_id');
        $game->game_number = $request->input('game_number');
        $game->next_game_id = $game_id;
        $game->red_player_id = $request->input('red_player');


        $game->blue_player_id = $request->input('blue_player');
        $game->save();

        $gameId = $game->id;

        $scoresheet = new Scoresheet();
        $scoresheet->game_id = $gameId;
        $scoresheet->save();

        return redirect()->route('organizer.games.index', ['competition_id' => $competition_id, 'game_id' => $game_id]);
    }

    public function createFinal($competition_id, Round $round)
    {

        $competition = Competition::where('round', $round->id);

        $styles = Style::all();
        $competitionClasses = CompetitionClass::all();
        $mats = Mat::where('competition_id', $competition->id)->get();
        $players = Player::all();
        $round = Round::find(8);

        return view('organizer.games.create-final', compact('styles', 'competitionClasses', 'mats', 'players', 'competition', 'round'));
    }

    public function storeFinal(Request $request, $competition_id)
    {
        $game = new Game();
        $game->competition_id = $competition_id;
        $game->style_id = $request->input('style');
        $game->competition_class_id = $request->input('competition_class');
        $game->mat_id = $request->input('mat');
        $game->round_id = $request->input('round_id');
        $game->game_number = $request->input('game_number');
        $game->red_player_id = $request->input('red_player');
        $game->blue_player_id = $request->input('blue_player');
        $game->save();

        $gameId = $game->id;

        $scoresheet = new Scoresheet();
        $scoresheet->game_id = $gameId;
        $scoresheet->save();

        return redirect()->route('organizer.games.index', ['competition_id' => $competition_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    // public function edit($competition_id, $game_id)
    // {
    //     $competition = Competition::find($competition_id);
    //     $game = Game::find($game_id);

    //     $allGames = Game::where('competition_id', $competition->id)
    //         ->with(
    //             'competition',
    //             'style',
    //             'competition_class',
    //             'mat',
    //             'round'
    //         )->get();

    //     $competitionPlayers = CompetitionPlayer::where('competition_id', $competition_id)->get();

    //     //上位の試合を取得(「下位の試合を作成」ボタンをクリックした試合)
    //     $topGame = Game::find($game_id);

    //     //下位の試合を取得
    //     $lowGames = $allGames->where('next_game_id', $topGame->id);

    //     $styles = Style::all();
    //     $competitionClasses = CompetitionClass::all();
    //     $mats = Mat::where('competition_id', $game->competition_id)->get();
    //     $players = Player::all();
    //     $rounds = Round::all();

    //     return view(
    //         'organizer.games.edit',
    //         ['competition_id' => $competition_id, 'game_id' => $game_id],
    //         compact('game', 'styles', 'competitionClasses', 'mats', 'players', 'competition', 'lowGames', 'rounds', 'competitionPlayers')
    //     );
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $competition_id, $game_id)
    // {
    //     $game = Game::find($game_id);
    //     $game->style_id = $request->input('style');
    //     $game->competition_class_id = $request->input('competition_class');
    //     $game->mat_id = $request->input('mat');
    //     $game->round_id = $request->input('round_id');
    //     $game->game_number = $request->input('game_number');

    //     $game->red_player_id = $request->input('red_player');
    //     $game->blue_player_id = $request->input('blue_player');
    //     $game->update();

    //     return redirect()->route('organizer.games.index', ['competition_id' => $competition_id]);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game, $competition_id, $game_id)
    {

        $game = Game::find($game_id);
        $game->delete();

        return redirect()->route('organizer.games.index', ['competition_id' => $competition_id]);
    }
}
