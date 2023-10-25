<div>
    <h2>スコアシート</h2>
    <h3>SCORE SHEET</h3>
</div>

<table>
    <tr>
        <th style="width: 14%">日付</th>
        <th style="width: 14%">マット</th>
        <th style="width: 14%">試合番号</th>
        <th style="width: 14%">カテゴリー</th>
        <th style="width: 14%">スタイル</th>
        <th style="width: 14%">階級</th>
        <th style="width: 14%">回戦</th>
    </tr>
    <tr>
        <td>{{ $date }}</td>
        <td>{{ $game->mat->name }}</td>
        <td>{{ $game->game_number }}</td>
        <td>{{ $competition->category->name }}</td>
        <td>{{ $game->style->name}}</td>
        <td>{{ $game->competition_class->class }}kg級</td>
        <td>{{ $game->round->round }}</td>
    </tr>
</table>

<form action="{{ route('organizer.scoresheets.store', ['competition_id' => $competition_id, 'game_id' => $game_id]) }}" method="POST">
    @csrf
    <table>
        <tr>
            <th colspan="2">赤コーナー</th>
            <th colspan="2">青コーナー</th>
        </tr>
        <tr>
            <th >名前</th>
            <th >所属</th>
            <th >名前</th>
            <th >所属</th>
        </tr>
        <tr>
            <td >{{ $game->red_player->name }}</td>
            <td >{{ $game->red_player->team->name }}</td>
            <td >{{ $game->blue_player->name }}</td>
            <td >{{ $game->blue_player->team->name }}</td>
        </tr>
        <tr>
            <td colspan="2"><input type="number" name="red_point" value="{{ is_null($scoresheet) ? 0 : $scoresheet->red_point }}"></td>
            <td colspan="2"><input type="number" name="blue_point" value="{{ is_null($scoresheet) ? 0 : $scoresheet->blue_point }}"></td>
        </tr>
    </table>

    <div>
        <strong>勝者</strong>
        @php
            function isVictoryPlayerId($player_id, $scoresheet){
                if (is_null($scoresheet)) {
                    return false;
                }
                return $player_id == $scoresheet->victory_player_id;
            }
        @endphp
        <select name="victory_player_id" id="victory_player_id">
            <option value="{{ $game->red_player->id }}" {{ isVictoryPlayerId($game->red_player->id, $scoresheet) ? "selected" : "" }}>赤コーナー：{{ $game->red_player->name }}</option>
            <option value="{{ $game->blue_player->id }}" {{ isVictoryPlayerId($game->blue_player->id, $scoresheet) ? "selected" : "" }}>青コーナー：{{ $game->blue_player->name }}</option>
        </select>
    </div>

    <div>
        <strong>勝因</strong>
        @php
            function isVictoryTypeId($victory_type_id, $scoresheet){
                if (is_null($scoresheet)) {
                    return false;
                }
                return $victory_type_id == $scoresheet->victory_type_id;
            }
        @endphp
        <select name="victory_type_id" id="victory_type_id">
            @foreach ($victory_types as $victory_type)
                <option value="{{ $victory_type->id }}" {{ isVictoryTypeId($victory_type->id, $scoresheet) ? "selected" : "" }}>{{ $victory_type->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit">送信</button>
    </div>
</form>

