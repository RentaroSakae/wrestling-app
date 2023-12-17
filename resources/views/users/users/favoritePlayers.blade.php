<div>
    <h2>お気に入り登録中の選手</h2>
</div>

<table>
    <tr>
        <th>選手名</th>
        <th>所属チーム</th>
        <th></th>
    </tr>
    @foreach ($favoritePlayers as $favoritePlayer)
        <tr>
            <td>{{ $favoritePlayer->favoriteable->name }}</td>
            <td>{{ $favoritePlayer->favoriteable->team->name }}</td>
            <td><a href="{{ route('users.favoritePlayerGames.index', [$favoritePlayer->favoriteable->id]) }}">試合情報</a>
            </td>
        </tr>
    @endforeach
</table>
