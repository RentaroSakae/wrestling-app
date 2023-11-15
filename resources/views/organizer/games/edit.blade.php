<div>
    <h2>試合番号{{ $game->game_number }}の編集</h2>
</div>

{{-- <div>
    <a href="{{ route('organizer.games.index', ['id' => $game->competition_id]) }}">試合一覧に戻る</a>
</div> --}}

<form action="{{ route('organizer.games.update', ['competition_id' => $competition_id, 'game_id' => $game_id]) }}"
    method="POST">
    @method('PUT')
    @csrf

    <div>
        <strong>スタイル</strong>
        <select id="style-selector" name="style">
            @foreach ($styles as $style)
                <option value="{{ $style->id }}" {{ $style->id == $game->style_id ? 'selected' : '' }}>
                    {{ $style->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <strong>階級</strong>
        <select id="class-selector" name="competition_class">
            @foreach ($competitionClasses as $competitionClass)
                <option value="{{ $competitionClass->id }}"
                    {{ $competitionClass->id == $game->competition_class_id ? 'selected' : '' }}>
                    {{ $competitionClass->class }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <strong>回戦</strong>
        <select id="round_id" name="round_id">
            @foreach ($rounds as $round)
                <option value="{{ $round->id }}" {{ $round->id == $game->round_id ? 'selected' : '' }}>
                    {{ $round->round }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <strong>マット</strong>
        <select name="mat" id="mat">
            @foreach ($mats as $mat)
                <option value="{{ $mat->id }}" {{ $mat->id == $game->mat_id ? 'selected' : '' }}>
                    {{ $mat->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <strong>試合番号</strong>
        <input type="number" name="game_number" id="Game_number" placeholder="game_number"
            value="{{ $game->game_number }}">
    </div>



    <div>
        <strong>赤コーナー選手</strong>
        @php
            $allLowGamesHaveScores = $lowGames->every(function ($game) {
                return $game->scoresheet && $game->scoresheet->victory_player;
            });
        @endphp

        <select name="red_player" id="red_player"
            {{ $lowGames->isNotEmpty() && !$allLowGamesHaveScores ? 'disabled' : '' }}>
            {{-- 下位の試合が存在して、すべてのスコアシートに勝者が記入されている場合 --}}
            @if ($lowGames->isNotEmpty() && $allLowGamesHaveScores)
                @foreach ($lowGames as $lowGame)
                    <option value="{{ $lowGame->scoresheet->victory_player_id }}">
                        {{ $lowGame->scoresheet->victory_player->name }}</option>
                @endforeach
                {{-- 下位の試合が存在しない、またはスコアシートに勝者が記入されていない場合 --}}
            @else
                @foreach ($competitionPlayers as $competitionPlayer)
                    <option value="{{ $competitionPlayer->player_id }}">{{ $competitionPlayer->player->name }}
                    </option>
                @endforeach
            @endif
        </select>

        {{-- 下位の試合が存在しているが、スコアシートが記入されていない場合のメッセージ --}}
        @if ($lowGames->isNotEmpty() && !$allLowGamesHaveScores)
            <p>下位の試合決定後に選手確定。</p>
            {{-- 下位の試合へのリンクを表示 --}}
            @foreach ($lowGames as $lowGame)
                <a
                    href="{{ route('organizer.games.edit', ['competition_id' => $lowGame->competition_id, 'game_id' => $lowGame->id]) }}">
                    試合番号{{ $lowGame->game_number }}を確認
                </a><br>
            @endforeach
        @endif
    </div>


    <div>
        <strong>青コーナー選手</strong>
        @php
            $allLowGamesHaveScores = $lowGames->every(function ($game) {
                return $game->scoresheet && $game->scoresheet->victory_player;
            });
        @endphp

        <select name="blue_player" id="blue_player"
            {{ $lowGames->isNotEmpty() && !$allLowGamesHaveScores ? 'disabled' : '' }}>
            {{-- 下位の試合が存在して、すべてのスコアシートに勝者が記入されている場合 --}}
            @if ($lowGames->isNotEmpty() && $allLowGamesHaveScores)
                @foreach ($lowGames as $lowGame)
                    <option value="{{ $lowGame->scoresheet->victory_player_id }}">
                        {{ $lowGame->scoresheet->victory_player->name }}</option>
                @endforeach
                {{-- 下位の試合が存在しない、またはスコアシートに勝者が記入されていない場合 --}}
            @else
                @foreach ($competitionPlayers as $competitionPlayer)
                    <option value="{{ $competitionPlayer->player_id }}">{{ $competitionPlayer->player->name }}
                    </option>
                @endforeach
            @endif
        </select>

        {{-- 下位の試合が存在しているが、スコアシートが記入されていない場合のメッセージ --}}
        @if ($lowGames->isNotEmpty() && !$allLowGamesHaveScores)
            <p>下位の試合決定後に選手確定。</p>
            {{-- 下位の試合へのリンクを表示 --}}
            @foreach ($lowGames as $lowGame)
                <a
                    href="{{ route('organizer.games.edit', ['competition_id' => $lowGame->competition_id, 'game_id' => $lowGame->id]) }}">
                    試合番号{{ $lowGame->game_number }}を確認
                </a><br>
            @endforeach
        @endif
    </div>



    <div>
        <button type="submit">更新</button>
    </div>
</form>
