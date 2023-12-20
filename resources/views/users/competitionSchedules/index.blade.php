<div>
    <h2>{{ $competition->name }}の大会スケジュール</h2>
</div>

<div>
    <a
        href="{{ route('users.categoriezedCompetition.index', ['competition' => $competition->id, 'categoriezedCompetition' => $categoriezedCompetition->id]) }}">{{ $competition->name }}詳細に戻る</a>
</div>

<div>
    @foreach ($mats as $mat)
        <a
            href="{{ route('users.matchOrders.index', ['competition' => $competition->id, 'mat' => $mat->id]) }}">{{ $mat->name }}のスケジュール</a>
    @endforeach
</div>

<table>
    @forelse ($schedules as $key => $group)
        @php
            // キーから日付とマット名を取得
            [$date, $matName] = explode(' ', $key, 2);
        @endphp
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
    @empty
        <tr>
            <th colspan="5">スケジュールが登録されていません。</th>
        </tr>
    @endforelse
</table>
