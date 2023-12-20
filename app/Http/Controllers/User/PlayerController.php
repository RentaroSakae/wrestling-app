<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::with(['team', 'favoriters'])->get();


        return view('users.players.index', compact('players'));
    }

    public function favorite(Player $player)
    {
        Auth::user()->togglefavorite($player);
        return back();
    }

    public function favoritePlayerGames(Request $request, Player $player)
    {
        $today = now()->format("Y-m-d");
        $target = $request->input('target');

        $classfiedCompetitions = $player->classfiedCompetitions()->with('categoriezed_competition')->get();

        $filteredCompetitions = $classfiedCompetitions->filter(function ($classfiedCompetition) use ($today, $target) {
            $categoriezedCompetition = $classfiedCompetition->categoriezed_competition;
            if (!$categoriezedCompetition) {
                return false;
            }

            if ($target === 'current') {
                return $categoriezedCompetition->start_at <= $today && $categoriezedCompetition->close_at >= $today;
            } elseif ($target === 'future') {
                return $categoriezedCompetition->start_at > $today;
            } elseif ($target === 'past') {
                return $categoriezedCompetition->close_at < $today;
            }
        });

        $query = Player::query();

        $games = Game::where(function ($query) use ($player) {
            $query->where('red_player_id', $player->id)
                ->orWhere('blue_player_id', $player->id);
        })->get()->each(function ($game) {
            $game->currentGameNumber = $game->currentGameNumber;
        });



        return view('users.favoritePlayerGames.index', compact('player', 'filteredCompetitions', 'games'));
    }
}
