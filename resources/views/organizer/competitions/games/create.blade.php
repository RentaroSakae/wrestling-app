<div>
    <h2>新しい試合を追加</h2>
</div>

<div>
    <a href="{{ route('competitions.index') }}">トップページに戻る</a>
</div>

<form action="{{ route('organizer.competitions.games.store', ['id' => $competition->id]) }}" method="POST">
    @csrf
    <div>
        <strong>試合番号</strong>
        <input type="number" name="game_number" id="Game_number">
    </div>
</form>
