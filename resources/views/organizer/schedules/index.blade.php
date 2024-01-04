<div>
    <h2>{{ $competition->name }}の大会スケジュール</h2>
</div>

@php
    // 現在のリクエストから 'target' パラメータを取得
    $currentTarget = request('target');
@endphp

<div>
    <a
        href="{{ route('organizer.matchOrder.index', ['competition' => $competition->id, 'mat' => $mat->id, 'target' => $currentTarget]) }}">マット別試合順</a>
</div>

<div>
    @foreach ($dateRange as $date)
        <a
            href="{{ route('organizer.schedules.index', ['competition' => $competition->id, 'mat' => $mat->id, 'target' => $date]) }}">{{ $date }}</a>
    @endforeach
</div>

<div>
    @foreach ($mats as $matItem)
        <a
            href="{{ route('organizer.schedules.index', ['competition' => $competition->id, 'mat' => $matItem->id, 'target' => $currentTarget]) }}">{{ $matItem->name }}のスケジュール</a>
    @endforeach
</div>

@if ($targetDate)
    <table>
        @forelse ($schedules as $key => $group)
            @php
                // キーから日付とマット名を取得
                [$date, $matName] = explode(' ', $key, 2);
            @endphp
            @if ($date === $targetDate)
                <tr>
                    <th colspan="5">{{ $date }}</th>
                </tr>
                <tr>
                    <th colspan="5">{{ $matName }}</th>
                </tr>
                <tr>
                    <th>カテゴリ</th>
                    <th>スタイル</th>
                    <th>階級</th>
                    <th>回戦</th>
                    <th>試合番号</th>
                    <th>試合数</th>
                </tr>
                @foreach ($group as $schedule)
                    <tr>
                        <td>{{ $schedule->round->classfiedCompetition->categoriezed_competition->category->name }}</td>
                        <td>{{ $schedule->round->classfiedCompetition->competitionClass->style->name }}</td>
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
            @endif
        @empty
            <tr>
                <th colspan="5">スケジュールが登録されていません。</th>
            </tr>
        @endforelse
    </table>
@endif
