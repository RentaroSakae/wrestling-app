<div>
    <h2>{{ $competitions->name }}の出場選手を追加</h2>
</div>

<form action="{{ route('organizer.competitions.players.store', ['id' => $competitions->id]) }}" method="POST">
    @csrf
    <div>
        <strong>氏名</strong>
        <input type="text" name="name" id="name">
    </div>

    <div>
        <strong>所属</strong>
        <input type="text" name="team" id="team">
    </div>

    <div>
        <button type="submit">送信</button>
    </div>
</form>
