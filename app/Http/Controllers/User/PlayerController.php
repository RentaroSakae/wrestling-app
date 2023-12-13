<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::with('team')->get();

        return view('users.players.index', compact('players'));
    }

    public function favorite(Player $player)
    {
        Auth::user()->togglefavorite($player);
        return back();
    }
}
