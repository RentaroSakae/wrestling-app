<div>
    <h2>通知登録中の選手一覧</h2>
</div>

<table>
    <tr>
        <th>開催時期</th>
        <th>大会名</th>
        <th>選手名</th>
        <th>チーム名</th>
        <th>試合通知タイミング</th>
    </tr>
    @foreach ($notifyPlayers as $notifyPlayer)
        <tr>
            {{-- 大会indexのやり方 --}}
            <td>{{ $notifyPlayer->classfiedCompetitionPlayer->categoriezedCompetition->start_at }} -
                {{ $notifyPlayer->classfiedCompetitionPlayer->categoriezedCompetition->start_at }}</td>
            <td>{{ $notifyPlayer->classfiedCompetitionPlayer->categoriezedCompetition->competition->name }}</td>
            <td>{{ $notifyPlayer->classfiedCompetitionPlayer->player->name }}</td>
            <td>{{ $notifyPlayer->classfiedCompetitionPlayer->player->team->name }}</td>
            <td>{{ $notifyPlayer->notify_before }}</td>
            {{-- 設定変更 --}}
            {{-- 削除 --}}
        </tr>
    @endforeach

</table>
