<div>
    <h2>選手一覧</h2>
</div>

<div>
    <a href="{{ route('organizer.index') }}">管理画面トップページに戻る</a>
</div>

<div>
    <a href="{{ route('organizer.players.create') }}">選手登録ページ</a>
</div>

<table>
    <tr>
        {{-- TODO 階級を反映させられるようにする --}}
        {{-- TODO 所属を反映させられるようにする --}}
        <th>選手名</th>
        <th>所属チーム</th>
    </tr>
    @if (count($players) > 0)
        @foreach ($players as $player)
            <tr>
                <td>{{ $player->name }}</td>
                <td>{{ $player->team->name }}</td>
                <td>
                    <form action="{{ route('organizer.players.destroy', $player->id) }}" method="POST">
                        {{-- <a href="{{ route('organizer.players.show', $player->id) }}">詳細</a> --}}
                        <a href="{{ route('organizer.players.edit', $player->id) }}">編集</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="2">登録中の選手がいません</td>
        </tr>
    @endif
</table>
