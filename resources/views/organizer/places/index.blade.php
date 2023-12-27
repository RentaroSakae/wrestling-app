<div>
    <h2>大会会場一覧</h2>
</div>

<div>
    <a href="{{ route('organizer.index') }}">管理画面トップページに戻る</a>
</div>

<div>
    <a href="{{ route('organizer.places.create') }}">大会会場を追加する</a>
</div>

<div>
    <a href="{{ route('organizer.competitions.index') }}">大会一覧ページ</a>
</div>

<table>
    <tr>
        <th>大会会場</th>
        <th>住所</th>
    </tr>
    @if (count($places) > 0)
        @foreach ($places as $place)
            <tr>
                <td>{{ $place->name }}</td>
                <td>{{ $place->address }}</td>
                <td>
                    <form action="{{ route('organizer.places.destroy', $place->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="2">登録中の大会会場はありません。</td>
        </tr>
    @endif
</table>
