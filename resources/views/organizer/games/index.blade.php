<div>
    <h2>{{ $competition->name }}の試合</h2>
</div>

{{-- <div>
    <a href="{{ route('organizer.games.index', ['target' => 'Amat']) }}">Aマット</a>
    <a href="{{ route('organizer.games.index', ['target' => 'Bmat']) }}">Bマット</a>
    <a href="{{ route('organizer.games.index', ['target' => 'Cmat']) }}">Cマット</a>
    <a href="{{ route('organizer.games.index', ['target' => 'Dmat']) }}">Dマット</a>
</div> --}}

<div>
    <a href="{{ route('organizer.games.create-final', ['competition_id' => $competition->id]) }}">決勝戦を作成</a>
</div>

<table>
    <tr>
        <th>マット</th>
        <th>試合番号</th>
        <th>スタイル</th>
        <th>階級</th>
        <th>回戦</th>
        <th>赤コーナーの選手</th>
        <th>青コーナーの選手</th>
    </tr>
    @foreach ($games as $game)
        <tr>
            <td>{{ $game->mat->name }}</td>
            <td>{{ $game->game_number }}</td>
            <td>{{ $game->style->name }}</td>
            <td>{{ $game->competition_class->class }}kg級</td>
            <td>{{ $game->round->round }}</td>
            <td>
                {{-- @if ($game->red_player)
                    {{ $game->red_player->name }}
                @else
                    選手未設定
                @endif --}}
                @if ($game->scoresheet && $game->scoresheet->victory_player)
                    {{ $game->scoresheet->victory_player->name }}
                    {{-- @elseif ($game->next_game_id)
                    試合番号{{ $game->next_games->game_number }}の勝者 --}}
                @elseif ($game->red_player)
                    {{ $game->red_player->name }}
                @else
                    選手未登録
                @endif
            </td>
            <td>
                @if ($game->blue_player)
                    {{ $game->blue_player->name }}
                @else
                    選手未設定
                @endif
            </td>
            <td>
                @if ($game->next_games->count() < 2)
                    <a
                        href="{{ route('organizer.games.create-lower', ['competition' => $game->competition_id, 'game' => $game->id]) }}">下位の試合を作成</a>
                @else
                    作成済み
                @endif
                <form
                    action="{{ route('organizer.games.destroy', ['competition_id' => $game->competition_id, 'game_id' => $game->id]) }}"
                    method="POST">

                    <a
                        href="{{ route('organizer.games.edit', ['competition_id' => $game->competition_id, 'game_id' => $game->id]) }}">編集</a>

                    {{-- @include('modals.caution_scoresheet') --}}
                    <a href="{{ route('organizer.scoresheets.create', ['competition_id' => $game->competition_id, 'game_id' => $game->id]) }}"
                        data-bs-toggle="modal" data-bs-target="#cautionScoresheetModal">スコアシート</a>

                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
