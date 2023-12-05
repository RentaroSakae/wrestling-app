<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CategoriezedCompetition;
use App\Models\ClassfiedCompetitionPlayer;
use App\Models\Competition;
use App\Models\UserCompetitionPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifyPlayerController extends Controller
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
    public function create(Competition $competition, ClassfiedCompetitionPlayer $classfiedCompetitionPlayer)
    {

        $categriezedCompetition = CategoriezedCompetition::where('competition_id', $competition->id)->first();

        return view('users.notifyPlayers.create',  compact('competition', 'classfiedCompetitionPlayer', 'categriezedCompetition'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Competition $competition, ClassfiedCompetitionPlayer $classfiedCompetitionPlayer)
    {
        // TODO バリデーション作る
        $user = Auth::user();
        $notify = new UserCompetitionPlayer();
        $notify->user_id = $user->id;
        $notify->classfied_competition_player_id = $classfiedCompetitionPlayer->id;
        $notify->notify_before = $request->input('notify_before');
        $notify->save();

        // TODO 通知登録一覧画面へのリダイレクトに変更する
        return redirect()->route('users.classfiedCompetitionPlayers.index', ['competition' => $competition->id, 'categoriezedCompetition' => $classfiedCompetitionPlayer->categoriezedCompetition->id, 'classfiedCompetition' => $classfiedCompetitionPlayer->classfiedCompetition->id]);
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
