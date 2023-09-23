<table>
    <tr>
        <th>大会名</th>
        <th>大会会場</th>
        <th>大会開始日時</th>
        <th>大会終了日時</th>
        <th>大会画像</th>
    </tr>
    @foreach($pastCompetitions as $pastCompetition)
    <tr>
        <td>{{ $pastCompetition->name }}</td>
        <td>{{ $pastCompetition->place->name }}</td>
        <td>{{ $pastCompetition->start_at }}</td>
        <td>{{ $pastCompetition->close_at }}</td>
        <td>{{ $pastCompetition->image_path }}</td>
        <td>
            <a href="{{ route('competitions.show',$Competition->id) }}">詳細</a>
        </td>
    </tr>
    @endforeach
</table>
