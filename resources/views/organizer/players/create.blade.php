<div>
    <h2>出場選手を追加</h2>
</div>

<form action="{{ route('organizer.players.store') }}" method="POST">
    @csrf
    <div>
        <strong>氏名</strong>
        <input type="text" name="name" id="name">
    </div>

    <div>
        <strong>所属チーム</strong>
        <select type="text" name="team" id="team">
            @foreach ($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit">送信</button>
    </div>
</form>
