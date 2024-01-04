<div>
    <h2>{{ $player->name }}選手の試合</h2>
</div>

<div>
    <a href="{{ route('users.favoritePlayerGames.index', ['player' => $player, 'target' => 'current']) }}">現在開催中の大会</a>
    <a href="{{ route('users.favoritePlayerGames.index', ['player' => $player, 'target' => 'future']) }}">近日開催予定の大会</a>
    <a href="{{ route('users.favoritePlayerGames.index', ['player' => $player, 'target' => 'past']) }}">過去に開催された大会</a>
</div>

<div>
    @foreach ($filteredCompetitions as $classfiedCompetition)
        <h3>{{ $classfiedCompetition->categoriezed_competition->competition->name }}</h3>
        <table>
            <tr>
                <th>マット</th>
                <th>試合番号</th>
                <th>スタイル</th>
                <th>階級</th>
                <th>赤コーナー</th>
                <th>得点（赤）</th>
                <th>青コーナー</th>
                <th>得点（青）</th>
                <th>勝者</th>
            </tr>
            @foreach ($games as $game)
                @if ($game->round->classfiedCompetition->id == $classfiedCompetition->id)
                    <tr>
                        <td>{{ $game->round->competitionSchedule->mat->name ?? 'N/A' }}</td>
                        <td>{{ $game->currentGameNumber }}</td>
                        <td>{{ $game->round->classfiedCompetition->competitionClass->style->name ?? 'N/A' }}</td>
                        <td>{{ $game->round->classfiedCompetition->competitionClass->class ?? 'N/A' }}</td>
                        <td>{{ $game->red_player->name ?? 'N/A' }}</td>
                        <td>{{ $game->scoresheet->red_point ?? 'N/A' }}</td>
                        <td>{{ $game->blue_player->name ?? 'N/A' }}</td>
                        <td>{{ $game->scoresheet->blue_point ?? 'N/A' }}</td>
                        <td>{{ $game->scoresheet->victory_player->name ?? 'N/A' }}</td>
                    </tr>
                @endif
            @endforeach
        </table>
    @endforeach
</div>
