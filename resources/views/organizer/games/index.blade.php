<div>
    <h2>{{ $competition->name }}の試合</h2>
</div>

{{-- <div>
    <a href="{{ route('organizer.games.index', ['target' => 'Amat']) }}">Aマット</a>
    <a href="{{ route('organizer.games.index', ['target' => 'Bmat']) }}">Bマット</a>
    <a href="{{ route('organizer.games.index', ['target' => 'Cmat']) }}">Cマット</a>
    <a href="{{ route('organizer.games.index', ['target' => 'Dmat']) }}">Dマット</a>
</div> --}}

<table>
    <tr>
        <th>試合番号</th>
        <th>スタイル</th>
        <th>階級</th>
        <th>赤コーナーの選手</th>
        <th>青コーナーの選手</th>
    </tr>
        @foreach ($games as $game)
        <tr>
            <td>{{ $game->game_number }}</td>
            <td>{{ $game->style->name }}</td>
            <td>{{ $game->competition_class->class }}kg級</td>
            <td>{{ $game->red_player->name }}</td>
            <td>{{ $game->blue_player->name }}</td>
            <td>
                <form action="{{ route('organizer.games.destroy', ['competition_id' => $game->competition_id, 'game_id' => $game->id]) }}" method="POST">
                    <a href="{{ route('organizer.games.edit', ['competition_id' => $game->competition_id, 'game_id' => $game->id]) }}">編集</a>
                    <a href="{{ route('organizer.scoresheets.create', ['competition_id' => $game->competition_id, 'game_id' => $game->id]) }}">スコアシート</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
</table>
