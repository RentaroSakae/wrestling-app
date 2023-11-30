<div>
    <h2>スコアシート</h2>
    <h3>SCORE SHEET</h3>
</div>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<table>
    <tr>
        <th style="width: 14%">日付</th>
        {{-- <th style="width: 14%">マット</th> --}}
        <th style="width: 14%">試合番号</th>
        <th style="width: 14%">カテゴリー</th>
        <th style="width: 14%">スタイル</th>
        <th style="width: 14%">階級</th>
        <th style="width: 14%">回戦</th>
    </tr>
    <tr>
        <td>{{ $date }}</td>
        {{-- <td>{{ $game->mat->name }}</td> --}}
        <td>{{ $game->game_number }}</td>
        <td>{{ $game->round->classfiedCompetition->categoriezed_competition->category->name }}</td>
        <td>{{ $game->round->classfiedCompetition->competitionClass->style->name }}</td>
        <td>{{ $game->round->classfiedCompetition->competitionClass->class }}kg級</td>
        <td>{{ $game->round->title }}</td>
    </tr>
</table>

<form action="{{ route('organizer.scoresheets.store', ['game' => $game->id]) }}" method="POST">
    @csrf
    <table>
        <tr>
            <th colspan="2">赤コーナー</th>
            <th colspan="2">青コーナー</th>
        </tr>
        <tr>
            <th>名前</th>
            <th>所属</th>
            <th>名前</th>
            <th>所属</th>
        </tr>
        <tr>
            <td>
                @if ($game->red_player)
                    {{ $game->red_player->name }}
                @else
                    選手が登録されていません。
                @endif
            </td>

            <td>
                @if ($game->red_player)
                    {{ $game->red_player->team->name }}
                @else
                    選手が登録されていません。
                @endif
            </td>

            <td>
                @if ($game->blue_player)
                    {{ $game->blue_player->name }}
                @else
                    選手が登録されていません。
                @endif
            </td>

            <td>
                @if ($game->blue_player)
                    {{ $game->blue_player->team->name }}
                @else
                    選手が登録されていません。
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="number" name="red_point"
                    value="{{ is_null($scoresheet) ? 0 : $scoresheet->red_point }}"></td>
            <td colspan="2"><input type="number" name="blue_point"
                    value="{{ is_null($scoresheet) ? 0 : $scoresheet->blue_point }}"></td>
        </tr>
    </table>

    @php
        $isVictoryPlayerId = function ($player_id, $scoresheet) {
            if (is_null($scoresheet)) {
                return false;
            }
            return $player_id == $scoresheet->victory_player_id;
        };
    @endphp

    <div>
        <strong>勝者</strong>
        @if ($game->red_player && $game->blue_player)
            <select name="victory_player_id" id="victory_player_id">
                <option value="{{ $game->red_player->id }}"
                    {{ $isVictoryPlayerId($game->red_player->id, $scoresheet) ? 'selected' : '' }}>
                    赤コーナー：{{ $game->red_player->name }}</option>
                <option value="{{ $game->blue_player->id }}"
                    {{ $isVictoryPlayerId($game->blue_player->id, $scoresheet) ? 'selected' : '' }}>
                    青コーナー：{{ $game->blue_player->name }}</option>
            </select>
        @else
            選手が登録されていません。
        @endif
    </div>


    <div>

        <strong>勝因</strong>
        @php
            $isVictoryTypeId = function ($victory_type_id, $scoresheet) {
                if (is_null($scoresheet)) {
                    return false;
                }
                return $victory_type_id == $scoresheet->victory_type_id;
            };
        @endphp
        <select name="victory_type_id" id="victory_type_id">
            @foreach ($victoryTypes as $victoryType)
                <option value="{{ $victoryType->id }}"
                    {{ $isVictoryTypeId($victoryType->id, $scoresheet) ? 'selected' : '' }}>
                    {{ $victoryType->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit">送信</button>
    </div>
</form>
