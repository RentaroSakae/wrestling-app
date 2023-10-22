<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

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

class CompetitionController extends Controller
{
    public function index(Request $request)
    {
        $today = now()->format("Y-m-d");
        $target = $request->input('target');

        $competitionsQuery = Competition::query()->with('place', 'category');

        if ($target === 'current') {
            // 現在開催中の大会を取得
            $competitionsQuery->where('start_at', '<=', $today)->where('close_at', '>=', $today);
        } elseif ($target === 'future') {
            // 近日開催予定の大会を取得
            $competitionsQuery->where('start_at', '>', $today);
        } elseif ($target === 'past') {
            // 過去に開催された大会を取得
            $competitionsQuery->where('close_at', '<', $today);
        } else {
            ///competitionsは現在開催中の大会を取得する
            $competitionsQuery->where('start_at', '<=', $today)->where('close_at', '>=', $today);
        }

        $currentCompetitions = $competitionsQuery->get();


        return view('users.competitions.index', compact('currentCompetitions', 'target'));
    }
}
