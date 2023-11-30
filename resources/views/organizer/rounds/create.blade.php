<div>
    <h2>{{ $classfiedCompetition->categoriezed_competition->competition->name }}・{{ $classfiedCompetition->categoriezed_competition->category->name }}・{{ $classfiedCompetition->competitionClass->style->name }}・{{ $classfiedCompetition->competitionClass->class }}のラウンド登録
    </h2>
</div>

<form action="{{ route('organizer.rounds.store', ['classfiedCompetition' => $classfiedCompetition->id]) }}"
    method="POST">
    @csrf

    <div>
        <strong>ラウンド</strong>
        <input type="text" name="title" id="Title">
    </div>

    <div>
        <strong>トーナメント or リーグ戦</strong>
        <select name="game_type" id="Game_type">
            @foreach ($gameTypes as $gameType)
                <option value="{{ $gameType->id }}">{{ $gameType->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <button type="submit">送信</button>
    </div>
</form>
