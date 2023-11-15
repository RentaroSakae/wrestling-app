<div>
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
                    {{-- TODO「通知登録」ボタンを設置 --}}
                </tr>
            @endif
        @endforeach
    </table>
</div>
