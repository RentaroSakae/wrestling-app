<div>
    <h2>{{ $competition->name }} {{ $categoriezedCompetition->category->name }}
        {{ $classfiedCompetition->competitionClass->style->name }}
        {{ $classfiedCompetition->competitionClass->class }}の出場選手一覧</h2>
</div>

<div>
    <a
        href="{{ route('users.categoriezedCompetition.index', ['competition' => $competition->id, 'categoriezedCompetition' => $categoriezedCompetition->id]) }}">{{ $competition->name }}詳細に戻る</a>
</div>

<div>
    @foreach ($categories as $category)
        <h3>{{ $category->category->name }}</h3>
        @foreach ($classes as $class)
            <a
                href="{{ route('users.classfiedCompetitionPlayers.index', [
                    'competition' => $competition->id,
                    'categoriezedCompetition' => $categoriezedCompetition->id,
                    'classfiedCompetition' => $class->id,
                ]) }}">{{ $class->competitionClass->class }}kg級</a>
        @endforeach
    @endforeach
</div>

<table>
    <tr>
        <th>選手名</th>
        <th>所属チーム</th>
        <th></th>
        <th></th>
    </tr>
    @foreach ($players as $player)
        <tr>
            <td>{{ $player->player->name }}</td>
            <td>{{ $player->player->team->name }}</td>

            {{-- TODO 試合結果 --}}
        </tr>
    @endforeach
</table>
















{{-- <div>
    <h2>{{ $competition->name }}の選手一覧</h2>
</div>

<div>
    <a
        href="{{ route('users.competition-players.index', ['competition_id' => $competition_id, 'target' => 'freestyle']) }}">フリースタイル</a>
    <a
        href="{{ route('users.competition-players.index', ['competition_id' => $competition_id, 'target' => 'grecoroman']) }}">グレコローマン</a>
    <a
        href="{{ route('users.competition-players.index', ['competition_id' => $competition_id, 'target' => 'woman']) }}">女子</a>
</div>

<div>
    @foreach ($competitionClasses as $competitionClass)
        @if ($target === 'freestyle')
            <a
                href="{{ route('users.competition-players.index', ['competition_id' => $competition_id, 'target' => 'freestyle', 'competition_class' => $competitionClass->id]) }}">{{ $competitionClass->class }}kg級</a>
        @elseif ($target === 'grecoroman')
            <a
                href="{{ route('users.competition-players.index', ['competition_id' => $competition_id, 'target' => 'grecoroman', 'competition_class' => $competitionClass->id]) }}">{{ $competitionClass->class }}kg級</a>
        @elseif ($target === 'woman')
            <a
                href="{{ route('users.competition-players.index', ['competition_id' => $competition_id, 'target' => 'woman', 'competition_class' => $competitionClass->id]) }}">{{ $competitionClass->class }}kg級</a>
        @else
            <a
                href="{{ route('users.competition-players.index', ['competition_id' => $competition_id, 'target' => 'freestyle', 'competition_class' => $competitionClass->id]) }}">{{ $competitionClass->class }}kg級</a>
        @endif
    @endforeach
</div>

<div>
    <table>
        <tr>
            <th>選手名</th>
            <th>所属</th>
        </tr>
        @foreach ($competitionPlayers as $competitionPlayer)
            @if ($competitionPlayer->competition_class_id == request('competition_class'))
                <tr>
                    <td>{{ $competitionPlayer->player->name }}</td>
                    <td>{{ $competitionPlayer->player->team->name }}</td>
                    {{-- TODO「通知登録」ボタンを設置
                </tr>
            @endif
        @endforeach
    </table>
</div> --}}
