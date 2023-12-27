<div>
    <h2>{{ $competition->name }} {{ $mat->name }}の試合順</h2>
</div>

<div>
    <a
        href="{{ route('users.categoriezedCompetition.index', ['competition' => $competition->id, 'categoriezedCompetition' => $categoriezedCompetition->id]) }}">{{ $competition->name }}詳細に戻る</a>
</div>

{{-- TODO 他のマットののaタグをforeachで作成 --}}
<div>
    @foreach ($mats as $mat)
        <a
            href="{{ route('users.matchOrders.index', ['competition' => $competition->id, 'mat' => $mat->id]) }}">{{ $mat->name }}の試合順</a>
    @endforeach
</div>

<table>
    <tr>
        <th>試合番号</th>
        <th>カテゴリ</th>
        <th>スタイル</th>
        <th>階級</th>
        <th>回戦</th>
        <th>赤コーナー</th>
        <th></th>
        <th>得点（赤）</th>
        <th></th>
        <th>得点（青）</th>
        <th></th>
        <th>青コーナー</th>
        <th></th>
    </tr>
    @foreach ($schedules as $schedule)
        @php $currentGameNumber = $schedule->totalGamesBefore @endphp
        @foreach ($schedule->round->games as $game)
            <tr>
                <td>{{ ++$currentGameNumber }}</td>
                <td>{{ $schedule->round->classfiedCompetition->categoriezed_competition->category->name }}</td>
                <td>{{ $schedule->round->classfiedCompetition->competitionClass->style->name }}</td>
                <td>{{ $schedule->round->classfiedCompetition->competitionClass->class }}</td>
                <td>{{ $schedule->round->title }}</td>
                <td>{{ $game->red_player->name ?? 'N/A' }}</td>
                <td>
                    @if (optional($game->scoresheet)->victory_player_id === $game->red_player_id)
                        ●
                    @endif
                </td>
                <td>{{ optional($game->scoresheet)->red_point }}</td>
                <td>-</td>
                <td>{{ optional($game->scoresheet)->blue_point }}</td>
                <td>
                    @if (optional($game->scoresheet)->victory_player_id === $game->blue_player_id)
                        ●
                    @endif
                </td>
                <td>{{ $game->blue_player->name ?? 'N/A' }}</td>
                <td>
                    <a
                        href="{{ route('users.scoresheets.show', ['competition' => $competition->id, 'categoriezedCompetition' => $game->round->classfiedCompetition->categoriezed_competition->id, 'classfiedCompetition' => $game->round->classfiedCompetition->id, 'game' => $game->id]) }}">スコアシート</a>
                </td>
            </tr>
        @endforeach
    @endforeach

</table>
