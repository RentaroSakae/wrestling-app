<div>
    <h2>{{ $classfiedCompetition->categoriezed_competition->competition->name }}
        {{ $classfiedCompetition->categoriezed_competition->category->name }}
        {{ $classfiedCompetition->competitionClass->style->name }}
        {{ $classfiedCompetition->competitionClass->class }}の選手登録</h2>
</div>

<form method="GET">

    <div>
        <strong>検索キーワード</strong>
        <input type="text" name="keyword" value="{{ $keyword }}">


    </div>
    <div>
        <button type="submit">検索</button>
    </div>
</form>

<form
    action="{{ route('organizer.classfiedCompetitionPlayers.store', ['classfiedCompetition' => $classfiedCompetition->id]) }}"
    method="POST">
    @csrf
    <div>
        <strong>選手</strong>
        <select name="player" id="Player">
            @foreach ($players as $player)
                <option value="{{ $player->id }}">{{ $player->name }}（{{ $player->team->name }}）</option>
            @endforeach
        </select>
    </div>
    <div>
        <button type="submit">送信</button>
    </div>
</form>
