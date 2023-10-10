<div>
    <h2>{{ $competitions->name }}の試合</h2>
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
            <td>{{ $game->CompetitionClass->class }}kg級</td>
            <td>{{ $game->players->name }}</td>
            <td>{{ $game->blue_player }}</td>
        </tr>
        @endforeach
</table>
