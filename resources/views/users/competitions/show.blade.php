<div>
    <h2>{{ $competition->name }}</h2>
</div>

<div>
    <a href="{{ route('users.games.index', ['competition_id' => $competition->id]) }}">試合一覧</a>
</div>

<div>
    <a href="{{ route('users.competition-players.index', ['competition_id' => $competition->id]) }}">出場選手一覧</a>
</div>
