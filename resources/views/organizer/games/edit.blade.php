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

    {{-- <div>
        <strong>赤コーナー</strong>
        <select name="red_player" id="Red_player">
            @if (!empty($victoryPlayers))
                @foreach ($victoryPlayers as $victoryPlayer)
                    <option value="{{ $victoryPlayer->id }}">{{ $victoryPlayer->name }}</option>
                @endforeach
            @else
                @foreach ($players as $player)
                    <option value="{{ $player->id }}">{{ $player->player->name }}</option>
                @endforeach
            @endif
        </select>
    </div> --}}

    {{-- <div>
        <strong>赤コーナー</strong>
        <select name="red_player" id="Red_player">
            @if (!empty($nextGames) && $nextGames->isNotEmpty())
                <!-- 次の試合の勝者を表すオプションのみ表示 -->
                @foreach ($nextGames as $nextGame)
                    <option value="winner_of_{{ $nextGame->id }}">試合番号{{ $nextGame->game_number }}の勝者</option>
                @endforeach
            @else
                <!-- そうでない場合は選手名を表示 -->
                @foreach ($players as $player)
                    <option value="{{ $player->id }}">{{ $player->player->name }}</option>
                @endforeach
            @endif
        </select>
    </div> --}}

    <div>
        <strong>赤コーナー</strong>
        <select name="red_player" id="red_player">
            @if (!empty($victoryPlayers))
                @foreach ($victoryPlayers as $victoryPlayer)
                    <option value="{{ $victoryPlayer->id }}">{{ $victoryPlayer->name }}</option>
                @endforeach
            @elseif ($nextGames->isNotEmpty())
                <option value="">未定</option>
            @else
                @foreach ($players as $player)
                    <option value="{{ $player->id }}">{{ $player->player->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div>
        <strong>青コーナー</strong>
        <select name="blue_player" id="Blue_player">
            @if (!empty($victoryPlayers))
                @foreach ($victoryPlayers as $victoryPlayer)
                    <option value="{{ $victoryPlayer->id }}">{{ $victoryPlayer->name }}</option>
                @endforeach
            @elseif ($nextGames->isNotEmpty())
                <option value="">未定</option>
            @else
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
