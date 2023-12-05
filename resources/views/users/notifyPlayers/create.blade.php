<div>
    <h2>通知設定</h2>
</div>

<div>
    <p>大会名{{ $competition->name }}</p>
    <p>大会期間：{{ $categriezedCompetition->start_at }}〜{{ $categriezedCompetition->close_at }}</p>
    <p>登録選手：{{ $classfiedCompetitionPlayer->player->name }}</p>
</div>

<form
    action="{{ route('users.notifyPlayers.store', ['competition' => $competition->id, 'classfiedCompetitionPlayer' => $classfiedCompetitionPlayer->id]) }}"
    method="POST">
    @csrf
    <div>
        <strong>通知タイミング</strong>
        <input type="number" name="notify_before" id="Notify_before">試合前
    </div>

    <div>
        <button type="submit">送信</button>
    </div>
</form>
