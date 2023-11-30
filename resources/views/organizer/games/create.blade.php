<div>
    <h2>{{ $round->classfiedCompetition->categoriezed_competition->competition->name }}・{{ $round->classfiedCompetition->categoriezed_competition->category->name }}・{{ $round->classfiedCompetition->competitionClass->style->name }}・{{ $round->classfiedCompetition->competitionClass->class }}kg級・{{ $round->title }}の試合作成
    </h2>
</div>

<form action="{{ route('organizer.games.store', ['round' => $round->id]) }}" method="POST">
    @csrf

    <div>
        <strong>No.</strong>
        <input type="number" name="game_number" id="Game_number">
    </div>

    <div>
        <strong>次の試合</strong>
        <select name="next_game_id" id="Next_game_id">
            <option value="">次の試合なし</option>
            @foreach ($games as $game)
                <option value="{{ $game->id }}">試合番号{{ $game->game_number }}番</option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit">送信</button>
    </div>
</form>
