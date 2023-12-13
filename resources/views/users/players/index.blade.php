<div>
    <h2>選手一覧</h2>
</div>

<table>
    <tr>
        <th>選手名</th>
        <th>所属</th>
        <th></th>
    </tr>
    @php
        $user = Auth::user();
    @endphp
    @foreach ($players as $player)
        <tr>
            <td>{{ $player->name }}</td>
            <td>{{ $player->team->name }}</td>
            <td>
                <form action="{{ route('users.players.favorite', $player) }}" method="POST">
                    @csrf

                    <button type="submit">

                        @if ($player->isFavoritedBy($user))
                            お気に入り解除
                        @else
                            お気に入り
                        @endif
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
