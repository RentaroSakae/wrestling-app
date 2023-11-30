<div>
    <h2>{{ $competition->name }}の大会スケジュール</h2>
</div>

<table>
    @foreach ($schedules as $schedule)
        <tr>
            <th colspan="5">{{ $schedule->date }}</th>
        </tr>
        <tr>
            <th colspan="5">{{ $schedule->mat->name }}</th>
        </tr>
        <tr>
            <th>カテゴリ</th>
            <th>階級</th>
            <th>回戦</th>
            <th>試合番号</th>
            <th>試合数</th>
        </tr>
        <tr>
            <td>{{ $schedule->round->classfiedCompetition->categoriezed_competition->category->name }}</td>
            <td>{{ $schedule->round->classfiedCompetition->competitionClass->class }}kg級</td>
            <td>{{ $schedule->round->title }}</td>
            <td>
                @php
                    $gameNumbers = $schedule->round->games->pluck('game_number');
                    $minGameNumber = $gameNumbers->min();
                    $maxGameNumber = $gameNumbers->max();
                @endphp
                {{ $minGameNumber }}〜{{ $maxGameNumber }}
            </td>
            <td>{{ $schedule->round->games->count() }}</td>
        </tr>
    @endforeach
</table>
