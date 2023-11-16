<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\CompetitionPlayer;
use App\Models\UserCompetitionPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCompetitionPlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Competition $competition, CompetitionPlayer $competition_player)
    {
        // 一般ユーザー画面12がcreate

        return view('users.notify-players.create', ['competition_id' => $competition->id, 'competition_player_id' => $competition_player->id], compact('competition', 'competition_player'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Competition $competition, CompetitionPlayer $competition_player)
    {
        // TODO バリデーション作る
        $user = Auth::user();
        $notify = new UserCompetitionPlayer();
        $notify->user_id = $user->id;
        $notify->competition_player_id = $competition_player->id;
        $notify->notify_before = $request->input('notify_before');
        $notify->save();

        // TODO 通知登録一覧画面へのリダイレクトに変更する
        return redirect()->route('users.competition-players.index', ['competition_id' => $competition->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
