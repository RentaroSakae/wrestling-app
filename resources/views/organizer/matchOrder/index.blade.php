<div>
    <h2>{{ $competition->name }} 試合順</h2>
</div>

@php
    // 現在のリクエストからクエリパラメータを取得
    $currentDate = request('targetDate');
    $currentMat = request('targetMat');
@endphp

<div>
    @foreach ($dateRange as $date)
        <a
            href="{{ route('organizer.matchOrder.index', ['competition' => $competition->id, 'targetDate' => $date, 'targetMat' => $currentMat]) }}">{{ $date }}</a>
    @endforeach
</div>

<div>
    @foreach ($mats as $matItem)
        <a
            href="{{ route('organizer.matchOrder.index', ['competition' => $competition->id, 'targetDate' => $currentDate, 'targetMat' => $matItem->id]) }}">{{ $matItem->name }}の試合順</a>
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
        <th>青コーナー</th>
    </tr>
    @foreach ($schedules as $schedule)
        @php $currentGameNumber = $schedule->totalGamesBefore @endphp
        @if ($schedule->round && $schedule->round->games->isNotEmpty())
            @foreach ($schedule->round->games as $game)
                <tr>
                    <td>{{ ++$currentGameNumber }}</td>
                    <td>{{ $schedule->round->classfiedCompetition->categoriezed_competition->category->name }}</td>
                    <td>{{ $schedule->round->classfiedCompetition->competitionClass->style->name }}</td>
                    <td>{{ $schedule->round->classfiedCompetition->competitionClass->class }}</td>
                    <td>{{ $schedule->round->title }}</td>
                    <td>{{ $game->red_player->name ?? 'N/A' }}</td>
                    <td>{{ $game->blue_player->name ?? 'N/A' }}</td>
                </tr>
            @endforeach
        @endif
    @endforeach
</table>
