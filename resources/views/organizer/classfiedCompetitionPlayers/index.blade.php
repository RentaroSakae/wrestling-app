<div>
    <h2>{{ $classfiedCompetition->categoriezed_competition->competition->name }}
        {{ $classfiedCompetition->categoriezed_competition->category->name }}
        {{ $classfiedCompetition->competitionClass->style->name }}
        {{ $classfiedCompetition->competitionClass->class }}の出場選手</h2>
</div>

<div>
    <a
        href="{{ route('organizer.classfiedCompetitionPlayers.create', ['classfiedCompetition' => $classfiedCompetition->id]) }}">選手を登録する</a>
</div>

<table>
    <tr>
        <th>選手名</th>
        <th>所属チーム</th>
    </tr>
    @if (count($classfiedCompetitionPlayers) > 0)
        @foreach ($classfiedCompetitionPlayers as $player)
            <tr>
                <td>{{ $player->player->name }}</td>
                <td>{{ $player->player->team->name }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="2">選手が登録されていません。</td>
        </tr>
    @endif

</table>
