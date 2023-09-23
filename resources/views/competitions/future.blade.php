<table>
    <tr>
        <th>大会名</th>
        <th>大会会場</th>
        <th>大会開始日時</th>
        <th>大会終了日時</th>
        <th>大会画像</th>
    </tr>
    @foreach($futureCompetitions as $futureCompetition)
    <tr>
        <td>{{ $futureCompetition->name }}</td>
        <td>{{ $futureCompetition->place->name }}</td>
        <td>{{ $futureCompetition->start_at }}</td>
        <td>{{ $futureCompetition->close_at }}</td>
        <td>{{ $futureCompetition->image_path }}</td>
        <td>
            <a href="{{ route('competitions.show',$competition->id) }}">詳細</a>
        </td>
    </tr>
    @endforeach
</table>
