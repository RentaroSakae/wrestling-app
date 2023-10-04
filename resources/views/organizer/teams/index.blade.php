<div>
    <h2>チーム一覧</h2>
</div>

<div>
    <a href="{{ route('organizer.teams.create') }}">チームを追加する</a>
</div>

<table>
    <tr>
        <th>チーム名</th>
    </tr>
    @if(count($teams) > 0)
        @foreach ($teams as $team)
        <tr>
            <td>{{ $team->name }}</td>
            <td>
                <form action="{{ route('organizer.teams.destroy', $team->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="2">登録中のチームはありません。</td>
        </tr>
    @endif
</table>
