<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CategoriezedCompetition;
use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Place;
use App\Models\Mat;
use App\Models\Category;
use App\Models\Game;
use App\Models\Player;
use App\Models\CompetitionClass;
use App\Models\Style;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CompetitionController extends Controller
{
    public function index(Request $request)
    {
        $competitions = Competition::all();
        $today = now()->format("Y-m-d");
        $target = $request->input('target');

        if (!$target && $request->session()->exists('target')) {
            $target = $request->session()->get('target');
        }

        $query = CategoriezedCompetition::query();

        if ($target === 'current') {
            // 現在開催中の大会を取得
            $query->where('start_at', '<=', $today)->where('close_at', '>=', $today);
        } elseif ($target === 'future') {
            // 近日開催予定の大会を取得
            $query->where('start_at', '>', $today);
        } elseif ($target === 'past') {
            // 過去に開催された大会を取得
            $query->where('close_at', '<', $today);
        } else {
            ///competitionsは現在開催中の大会を取得する
            $query->where('start_at', '<=', $today)->where('close_at', '>=', $today);
        }

        $categoriezedCompetitions = $query->get();

        if ($target) {
            $request->session()->put('target', $target);
        }
        Log::debug('選択されたターゲット' . $target);
        return view('users.competitions.index', compact('categoriezedCompetitions', 'target'));
    }



    public function show(Competition $competition)
    {

        return view('users.competitions.show', compact('competition'));
    }
}
