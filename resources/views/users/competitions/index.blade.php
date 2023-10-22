<div>
    <a href="{{ route('users.competitions.index', ['target' => 'current']) }}">現在開催中の大会</a>
        <a href="{{ route('users.competitions.index', ['target' => 'future']) }}">近日開催予定の大会</a>
        <a href="{{ route('users.competitions.index', ['target' => 'past']) }}">過去に開催された大会</a>
</div>

{{-- TODO ソート機能追加 --}}
{{-- TODO 検索機能追加 --}}

<table>
    <tr>
        <th>大会日時</th>
        <th>大会名</th>
        <th>カテゴリ</th>
        <th>大会会場</th>

    </tr>
    @if(count($currentCompetitions) > 0)
        @foreach($currentCompetitions as $competition)
        <tr>
            <td>{{ $competition->start_at }} 〜 {{ $competition->close_at }}</td>
            <td>{{ $competition->name }}</td>
            <td>{{ $competition->category->name }}</td>
            <td>{{ $competition->place->name }}</td>
            {{-- TODO showアクション追加 --}}
            {{-- <td>
                <a href="{{ route('user.competitions.show', $competition->id) }}">詳細</a>
            </td> --}}
        </tr>
{{-- TODO ページドネーション追加 --}}
        @endforeach
    @else
        <tr>
            <td colspan="6">該当する大会がありません。</td>
        </tr>
    @endif
</table>
