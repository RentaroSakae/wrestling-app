<div>
    <h2>{{ $competition->name }}の決勝戦を追加</h2>
</div>

<div>
    <a
        href="{{ route('organizer.games.index', ['competition_id' => $competition->id]) }}">{{ $competition->name }}の試合一覧ページに戻る</a>
</div>

<form action="{{ route('organizer.games.store-final', ['competition_id' => $competition->id]) }}" method="POST">
    @csrf
    <div>
        <strong>スタイル</strong>
        <select id="style-selector" name="style">
            @foreach ($styles as $style)
                <option value="{{ $style->id }}">{{ $style->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <strong>階級</strong>
        <select id="class-selector" name="competition_class">
            @foreach ($competitionClasses as $competitionClass)
                <option value="{{ $competitionClass->id }}">{{ $competitionClass->class }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <strong>マット</strong>
        <select name="mat" id="mat">
            @foreach ($mats as $mat)
                <option value="{{ $mat->id }}">{{ $mat->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <strong>試合番号</strong>
        <input type="number" name="game_number" id="Game_number">
    </div>

    <div>
        <input type="hidden" name="round_id" id="round_id" value="{{ $round->id }}">
    </div>

    <div>
        <button type="submit">送信</button>
    </div>

</form>
