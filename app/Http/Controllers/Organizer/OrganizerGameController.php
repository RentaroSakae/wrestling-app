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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {

        $game = Game::find($game->id);
        $game->delete();

        return redirect()->route('organizer.rounds.index', ['classfiedCompetition' => $game->round->classfiedCompetition->id]);
    }
}
