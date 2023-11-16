<div>
    <h2>通知設定</h2>
</div>

<div>
    <p>大会名{{ $competition->name }}</p>
    <p>大会期間：{{ $competition->start_at }}〜{{ $competition->close_at }}</p>
    <p>登録選手：{{ $competition_player->player->name }}</p>
</div>

<form
    action="{{ route('users.notify-players.store', ['competition' => $competition->id, 'competition_player' => $competition_player->id]) }}"
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
