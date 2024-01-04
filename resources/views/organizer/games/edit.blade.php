<div>
    <h2>試合番号{{ $game->game_number }}の編集</h2>
</div>

{{-- <div>
    <a href="{{ route('organizer.games.index', ['id' => $game->competition_id]) }}">試合一覧に戻る</a>
</div> --}}



<form action="{{ route('organizer.games.update', ['game' => $game->id]) }}" method="POST">
    @method('PUT')
    @csrf

    <div>
        <strong>No.</strong>
        <input type="number" name="game_number" id="Game_number" value="{{ $game->game_number }}">
    </div>

    <div>
        <strong>赤コーナー</strong>
        <select name="red_player" id="red_player">
            <!-- 現在のゲームの赤コーナーの選手を追加（存在する場合） -->
            @if ($game->red_player)
                <option value="{{ $game->red_player->id }}">{{ $game->red_player->name }}</option>
            @endif

            <!-- 勝者のリストを追加 -->
            @foreach ($victoryPlayers as $victoryPlayer)
                <option value="{{ $victoryPlayer->id }}">{{ $victoryPlayer->name }}</option>
            @endforeach

            <!-- その他の選手を追加（nextGamesがある場合）-->
            @if ($nextGames->isNotEmpty() && $nextGames->first()->players)
                <option value="">未定</option>
                @foreach ($nextGames->first()->players as $player)
                    <option value="{{ $player->id }}">{{ $player->player->name }}</option>
                @endforeach
            @endif

            <!-- 全プレイヤーリスト（nextGamesが空の場合） -->
            @if ($nextGames->isEmpty())
                @foreach ($players as $player)
                    <option value="{{ $player->id }}">{{ $player->player->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div>
        <strong>青コーナー</strong>
        <select name="blue_player" id="Blue_player">
            <!-- 現在のゲームの赤コーナーの選手を追加（存在する場合） -->
            @if ($game->blue_player)
                <option value="{{ $game->blue_player->id }}">{{ $game->blue_player->name }}</option>
            @endif

            <!-- 勝者のリストを追加 -->
            @foreach ($victoryPlayers as $victoryPlayer)
                <option value="{{ $victoryPlayer->id }}">{{ $victoryPlayer->name }}</option>
            @endforeach

            <!-- その他の選手を追加（nextGamesがある場合）-->
            @if ($nextGames->isNotEmpty() && $nextGames->first()->players)
                <option value="">未定</option>
                @foreach ($nextGames->first()->players as $player)
                    <option value="{{ $player->id }}">{{ $player->player->name }}</option>
                @endforeach
            @endif

            <!-- 全プレイヤーリスト（nextGamesが空の場合） -->
            @if ($nextGames->isEmpty())
                @foreach ($players as $player)
                    <option value="{{ $player->id }}">{{ $player->player->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div>
        <strong>次の試合</strong>
        <select name="next_game_id" id="Next_game_id">
            <option value="" {{ $currentNextGameId == null ? 'selected' : '' }}>次の試合なし</option>
            @foreach ($games as $game)
                <option value="{{ $game->id }}" {{ $currentNextGameId == $game->id ? 'selected' : '' }}>
                    試合番号{{ $game->game_number }}番</option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit">更新</button>
    </div>
</form>
