@extends('layouts.wrestlingapp')

@section('title', '登録選手戦績')

@section('content')

    <div class="wrestlingapp-content d-flex justify-content-center" style="min-height: 100vh;">
        <div style="width: 100%">
            <div class="mb-3">
                <h2 class="fs-4 mt-5 d-flex justify-content-center">{{ $player->name }}選手の試合</h2>
            </div>

            <div class="d-flex justify-content-center pt-3">
                <a href="{{ route('users.favoritePlayerGames.index', ['player' => $player, 'target' => 'current']) }}"
                    class="btn btn-outline-primary wrestlingapp-class-button {{ request()->get('target') == 'current' ? 'active' : '' }}">
                    Ongoing</a>
                <a href="{{ route('users.favoritePlayerGames.index', ['player' => $player, 'target' => 'future']) }}"
                    class="btn btn-outline-primary wrestlingapp-class-button {{ request()->get('target') == 'future' ? 'active' : '' }}">
                    Up-coming</a>
                <a href="{{ route('users.favoritePlayerGames.index', ['player' => $player, 'target' => 'past']) }}"
                    class="btn btn-outline-primary wrestlingapp-class-button {{ request()->get('target') == 'past' ? 'active' : '' }}">
                    Past</a>
            </div>

            <div>
                <div class="mt-3">
                    @foreach ($filteredCompetitions as $classfiedCompetition)
                        <h3 class="fs-5 d-flex justify-content-center">
                            {{ $classfiedCompetition->categoriezed_competition->competition->name }}</h3>
                </div>
                {{-- PC用テーブル --}}
                <div class="wrestlingapp-table-width d-flex d-none d-md-block">
                    <table class="table m-4 text-center align-middle table-striped">
                        <tr class="fs-5">
                            <th class="px-2">マット</th>
                            <th class="px-2">試合番号</th>
                            <th class="px-2">スタイル</th>
                            <th class="px-2">階級</th>
                            <th class="px-2">赤コーナー</th>
                            <th class="px-2">得点（赤）</th>
                            <th class="px-2">青コーナー</th>
                            <th class="px-2">得点（青）</th>
                            <th class="px-2">勝者</th>
                        </tr>
                        @foreach ($games as $game)
                            @if ($game->round->classfiedCompetition->id == $classfiedCompetition->id)
                                <tr class="wrestlingapp-row-height fs-6">
                                    <td class="px-2">
                                        {{ $game->round->competitionSchedule->mat->name ?? 'N/A' }}</td>
                                    <td class="px-2">{{ $game->currentGameNumber }}</td>
                                    <td class="px-2">
                                        {{ $game->round->classfiedCompetition->competitionClass->style->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-2">
                                        {{ $game->round->classfiedCompetition->competitionClass->class ?? 'N/A' }}
                                    </td>
                                    <td class="px-2">{{ $game->red_player->name ?? 'N/A' }}</td>
                                    <td class="px-2">{{ $game->scoresheet->red_point ?? 'N/A' }}</td>
                                    <td class="px-2">{{ $game->blue_player->name ?? 'N/A' }}</td>
                                    <td class="px-2">{{ $game->scoresheet->blue_point ?? 'N/A' }}</td>
                                    <td class="px-2">{{ $game->scoresheet->victory_player->name ?? 'N/A' }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>

                {{-- スマホ用リスト --}}
                <div class="list-group d-block d-md-none mt-3 mb-2 macthorder-list">
                    {{-- 上の行 --}}
                    <div class="list-upper-content mb-2 d-flex pt-2 text-center">
                        <div class="flex-fill">
                            {{ $game->round->competitionSchedule->mat->name ?? 'N/A' }}
                        </div>
                        <div class="flex-fill">
                            {{ $game->currentGameNumber }}番
                        </div>
                        <div class="flex-fill">
                            {{ $game->round->classfiedCompetition->competitionClass->style->name ?? 'N/A' }}
                        </div>
                        <div class="flex-fill">
                            {{ $game->round->classfiedCompetition->competitionClass->class ?? 'N/A' }}kg級
                        </div>
                    </div>
                    {{-- 中の行 --}}
                    <div class="list-middle-content mb-2 mt-2 d-flex text-center">
                        <div class="flex-fill">
                            {{ $game->red_player->name ?? 'N/A' }}
                        </div>
                        <div class="flex-fill">
                            {{ $game->scoresheet->red_point ?? 'N/A' }}
                        </div>
                        <div class="flex-fill">
                            -
                        </div>
                        <div class="flex-fill">
                            {{ $game->scoresheet->blue_point ?? 'N/A' }}

                        </div>
                        <div class="flex-fill">
                            {{ $game->blue_player->name ?? 'N/A' }}
                        </div>
                    </div>
                    {{-- 下の行 --}}
                    <div class="list-lower-content mb-2 d-flex justify-content-center">
                        <div class="flex-fill text-center">
                            勝者：{{ $game->scoresheet->victory_player->name ?? 'N/A' }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-5">
                <a href="{{ route('users.users.favoritePlayers') }}"
                    class="btn btn-outline-primary wrestlingapp-class-button justify-content-center">登録選手一覧に戻る</a>
            </div>
        </div>
    </div>
@endsection
