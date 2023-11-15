<div>
    <h2>{{ $competition->start_at }}〜 {{ $competition->name }}</h2>
</div>

<div>
    @foreach ($mats as $mat)
        <a
            href='{{ route('users.games.index', ['competition_id' => $competition_id]) . '?mat_id=' . $mat->id }}'>{{ $mat->name }}</a>
    @endforeach
</div>

<table>
    <tr>
        <th colspan="3"></th>
        <th colspan="3">赤</th>
        <th></th>
        <th colspan="3">青</th>
    </tr>
    <tr>
        <th>マット</th>
        <th>試合番号</th>
        <th>スタイル</th>
        <th>階級</th>
        <th>回戦</th>
        <th>赤コーナー/所属</th>
        <th></th>
        <th>得点</th>
        <th></th>
        <th>得点</th>
        <th></th>
        <th>青コーナー/所属</th>
    </tr>
    @if (count($games) > 0)
        @foreach ($games as $game)
            @if ($game->red_player && $game->blue_player)
                <tr>
                    <td rowspan="2">{{ $game->mat->name }}</td>
                    <td rowspan="2">{{ $game->game_number }}</td>
                    <td rowspan="2">{{ $game->style->name }}</td>
                    <td rowspan="2">{{ $game->competition_class->class }}kg級</td>
                    <td rowspan="2">{{ $game->round->round }}</td>
                    <td>{{ $game->red_player->name }}</td>
                    <td rowspan="2">
                        @if (optional($game->scoresheet)->victory_player_id === $game->red_player->id)
                            ●
                        @endif
                    </td>
                    <td rowspan="2">{{ optional($game->scoresheet)->red_point }}</td>
                    <td rowspan="2">-</td>
                    <td rowspan="2">{{ optional($game->scoresheet)->blue_point }}</td>
                    <td rowspan="2">
                        @if (optional($game->scoresheet)->victory_player_id === $game->blue_player->id)
                            ●
                        @endif
                    </td>
                    <td>{{ $game->blue_player->name }}</td>
                </tr>
                <tr>
                    <td>{{ $game->red_player->team->name }}</td>
                    <td>{{ $game->blue_player->team->name }}</td>
                </tr>
            @endif
        @endforeach
    @else
        <tr>
            <td colspan="11">該当する大会がありません。</td>
        </tr>
    @endif

</table>
