<div>
    <h2>{{ $categoriezedCompetition->start_at }}〜 {{ $competition->name }}の詳細</h2>
</div>

<div>
    <a href="{{ route('users.competitions.index') }}">大会一覧に戻る</a>
</div>

<div>
    <h3>出場選手</h3>
    @foreach ($classes as $class)
        <a
            href="{{ route('users.classfiedCompetitionPlayers.index', [
                'competition' => $competition->id,
                'categoriezedCompetition' => $categoriezedCompetition->id,
                'classfiedCompetition' => $class->id,
            ]) }}">{{ $class->competitionClass->class }}kg級</a>
    @endforeach
</div>

<div>
    <h3>各マット大会スケジュール</h3>
    @foreach ($mats as $mat)
        <a
            href="{{ route('users.competitionSchedules.index', ['competition' => $mat->competition->id, 'mat' => $mat->id]) }}">{{ $mat->name }}</a>
    @endforeach
</div>

<div>
    <a href="{{ route('users.matchOrders.index', ['competition' => $competition->id, 'mat' => $mat->id]) }}">対戦表・試合結果</a>
</div>
