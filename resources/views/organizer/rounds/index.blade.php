<div>
    <h2>{{ $classfiedCompetition->categoriezed_competition->competition->name }}・{{ $classfiedCompetition->categoriezed_competition->category->name }}・{{ $classfiedCompetition->competitionClass->style->name }}・{{ $classfiedCompetition->competitionClass->class }}のラウンド一覧
    </h2>
</div>

{{-- 「大会スケジュール作成」のaタグ --}}
{{-- 「マット別試合順」のaタグ --}}
{{-- 「リーグ戦の試合作成」のaタグ --}}

@foreach ($rounds as $round)
    <h3>{{ $round->title }}</h3>

    <div>
        <a href="{{ route('organizer.games.create', ['round' => $round->id]) }}">試合を作成</a>
    </div>
    <div>
        <a href="{{ route('organizer.schedules.create', ['round' => $round->id]) }}">スケジュールを作成する</a>
    </div>

    @if ($round->games)
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>赤コーナー</th>
                    <th>青コーナー</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($round->games as $game)
                    <tr>
                        <td>{{ $game->game_number }}</td>
                        <td>{{ $game->red_player->name ?? '未定' }}</td>
                        <td>{{ $game->blue_player->name ?? '未定' }}</td>
                        <td>
                            <a href="{{ route('organizer.games.edit', ['game' => $game->id]) }}">編集</a>
                        </td>
                        <td>
                            <a
                                href="{{ route('organizer.scoresheets.create', ['game' => $game->scoresheet->id]) }}">スコアシート</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>このラウンドにはゲームがありません。</p>
    @endif
@endforeach
