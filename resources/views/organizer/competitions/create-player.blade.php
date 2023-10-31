<strong>{{ $competition->name }}の選手登録</strong>

<form action="{{ route('organizer.competitions.players.store', ['competition_id' => $competition->id]) }}" method="POST">
    @csrf
    <div>
        <strong>スタイル</strong>
        <select name="style_id" id="style_id">
            @foreach ($styles as $style)
                <option value="{{ $style->id }}">{{ $style->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <strong>階級</strong>
        <select name="competition_class_id" id="competition_class_id">
            @foreach ($competitionClasses as $competitionClass)
                <option value="{{ $competitionClass->id }}">{{ $competitionClass->class }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <strong>選手</strong>
        <select name="player_id">
            @foreach($players as $player)
                <option value="{{ $player->id }}">{{ $player->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- スタイルや階級の選択肢もここに追加 -->

    <button type="submit">登録</button>
</form>
