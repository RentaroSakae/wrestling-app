<div>
    <h2>{{ $competition->name }} {{ $mat->name }}の試合順</h2>
</div>

{{-- TODO 他のマットののaタグをforeachで作成 --}}
<div>
    @foreach ($mats as $mat)
        <a
            href="{{ route('organizer.matchOrder.index', ['competition' => $competition->id, 'mat' => $mat->id]) }}">{{ $mat->name }}の試合順</a>
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
    @endforeach
</table>
