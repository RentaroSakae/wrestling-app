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
use Illuminate\Support\Facades\Auth;

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

    public function show(Competition $competition)
    {

        return view('users.competitions.show', compact('competition'));
    }

    public function favorite(Competition $competition)
    {

        if (is_null($competition->id)) {
            // エラーハンドリング: $competitionが有効なIDを持っていない場合
            abort(404); // あるいは他の適切なエラーレスポンス
        }
        Auth::user()->toggleFavorite($competition);

        return back();
    }

    public function unfavorite(Competition $competition)
    {
        $user = Auth::user();

        // お気に入りから削除する処理
        $user->toggleFavorite($competition);

        // リダイレクト、フラッシュメッセージ、その他の必要なレスポンス
        return back();
    }
}
