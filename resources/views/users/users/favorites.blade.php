<div>
    <h2>お気に入りの大会一覧</h2>
</div>

{{-- TODO マイページに戻るaタグを作成 --}}

<div>
    <table>
        <tr>
            <th>日時</th>
            <th>大会名</th>
            <th>会場</th>
            <th></th>
        </tr>
        @if (count($favorites) > 0)
            @foreach ($favorites as $favorite)
                <tr>
                    <td>{{ App\Models\Competition::find($favorite->favoriteable_id)->start_at }}</td>
                    <td>{{ App\Models\Competition::find($favorite->favoriteable_id)->name }}</td>
                    <td>{{ App\Models\Competition::find($favorite->favoriteable_id)->place->name }}</td>
                    <td>
                        <form action="{{ route('users.competitions.unfavorite', $favorite->favoriteable_id) }}"
                            method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">お気に入り解除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4">お気に入り登録中の大会はありません。</td>
            </tr>
        @endif
    </table>
</div>
