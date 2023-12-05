<div>
    <h2>スコアシート</h2>
</div>

<table>
    <tr>
        <th>大会名</th>
    </tr>
    <tr>
        <td>{{ $competition->name }}</td>
    </tr>
</table>

<table>
    <tr>
        <th>日付</th>
        <th>マット</th>
        {{-- <th>試合番号</th> --}}
        <th>カテゴリー</th>
        <th>スタイル</th>
        <th>階級</th>
        <th>回戦</th>
    </tr>

    @php
        $matchOrders = session('matchOrders', []);
        $gameNumber = $matchOrders[$game->id] ?? 'N/A'; // $gameIdは取得する試合のID
    @endphp
    <tr>
        <td>{{ $competitionSchedule->date }}</td>
        <td>{{ $competitionSchedule->mat->name }}</td>
        {{-- <td>{{ $gameNumber }}</td> --}}
        <td>{{ $categoriezedCompetition->category->name }}</td>
        <td>{{ $classfiedCompetition->competitionClass->style->name }}</td>
        <td>{{ $classfiedCompetition->competitionClass->class }}kg級</td>
        <td>{{ $game->round->title }}</td>
    </tr>
</table>

<table>
    <tr>
        <th colspan="2">RED 赤</th>
        <th colspan="2">BLUE 青</th>
    </tr>
    <tr>
        <td>NAME 名前</td>
        <td>COUNTY 所属（国）名</td>
        <td>NAME 名前</td>
        <td>COUNTY 所属（国）名</td>
    </tr>
    <tr>
        <td>
            @if ($game->red_player)
                {{ $game->red_player->name }}
            @else
                N/A
            @endif
        </td>

        <td>
            @if ($game->red_player)
                {{ $game->red_player->team->name }}
            @else
                N/A
            @endif
        </td>

        <td>
            @if ($game->blue_player)
                {{ $game->blue_player->name }}
            @else
                N/A
            @endif
        </td>

        <td>
            @if ($game->blue_player)
                {{ $game->blue_player->team->name }}
            @else
                N/A
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="2">{{ $game->scoresheet->red_point }}</td>
        <td colspan="2">{{ $game->scoresheet->blue_point }}</td>
    </tr>
</table>

<div>
    <strong>勝者</strong>
    @if ($game->red_player && $game->blue_player)
        <p>{{ $game->scoresheet->victory_player->name }}</p>
    @else
        N/A
    @endif
</div>

<div>
    <strong>勝因</strong>
    @if ($game->scoresheet->victory_type)
        {{ $game->scoresheet->victory_type->name }}
    @else
        N/A
    @endif
</div>
