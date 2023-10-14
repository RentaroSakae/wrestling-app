<div>
    <h2>{{ $game->red_player->name }} vs {{ $game->blue_player->name }}の編集</h2>
</div>

{{-- <div>
    <a href="{{ route('organizer.games.index', ['id' => $game->competition_id]) }}">試合一覧に戻る</a>
</div> --}}

<form action="{{ route('organizer.games.update', ['competition_id' => $competition_id, 'game_id' => $game_id]) }}" method="POST">
    @method('PUT')
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
        <strong>赤コーナー選手</strong>
        <select name="red_player" id="red_player">
            @foreach ($players as $player)
            <option value="{{ $player->id }}">{{ $player->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <strong>青コーナー選手</strong>
        <select name="blue_player" id="blue_player">
            @foreach ($players as $player)
            <option value="{{ $player->id }}">{{ $player->name }}</option>
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
        <input type="number" name="game_number" id="Game_number" placeholder="game_number">
    </div>

    <div>
        <button type="submit">更新</button>
    </div>
</form>
