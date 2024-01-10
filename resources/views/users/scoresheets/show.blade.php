@extends('layouts.wrestlingapp')

@section('title', 'スコアシート')

@section('content')

    <div class="wrestlingapp-content d-flex justify-content-center" style="min-height: 100vh;">
        <div>
            <div class="mb-3">
                <div>
                    <h2 class="fs-4 mt-5 d-flex justify-content-center">{{ $competition->name }}</h2>
                </div>
            </div>
            <div>
                <h3 class="fs-5 d-flex justify-content-center">- スコアシート -</h2>
            </div>
            <div class="container">
                <div class="wrestlingapp-table-witdh d-flex justify-content-center">
                    <table class="table table-borderless m-4 text-center align-middle">
                        <tr>
                            <th>日付</th>
                            <th>マット</th>
                            {{-- <th>試合番号</th> --}}
                            <th>カテゴリー</th>
                            <th>スタイル</th>
                            <th>階級</th>
                            <th>回戦</th>
                        </tr>

                        @php
                            $matchOrders = session('matchOrders', []);
                            $gameNumber = $matchOrders[$game->id] ?? 'N/A'; // $gameIdは取得する試合のID
                        @endphp
                        <tr>
                            <td>{{ $competitionSchedule->date }}</td>
                            <td>{{ $competitionSchedule->mat->name }}</td>
                            {{-- <td>{{ $gameNumber }}</td> --}}
                            <td>{{ $categoriezedCompetition->category->name }}</td>
                            <td>{{ $classfiedCompetition->competitionClass->style->name }}</td>
                            <td>{{ $classfiedCompetition->competitionClass->class }}kg級</td>
                            <td>{{ $game->round->title }}</td>
                        </tr>
                    </table>
                </div>
                {{-- ↓aroundが機能していない？ --}}
                <div class="row justify-content-around text-center">
                    <table class="col table table-bordered scoresheet-red-border">
                        <tr>
                            <th class="fs-6">RED 赤</th>
                        </tr>
                        <tr>
                            <td class="fs-6">
                                @if ($game->red_player)
                                    {{ $game->red_player->name }}
                                @else
                                    N/A
                                @endif
                                <br>
                                @if ($game->red_player)
                                    {{ $game->red_player->team->name }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="scoresheet-point-fontsize">{{ $game->scoresheet->red_point }}</td>
                        </tr>
                    </table>

                    <table class="col table table-bordered">
                        <tr>
                            <th class="fs-6">BLUE 青</th>
                        </tr>
                        <tr>
                            <td class="fs-6">
                                @if ($game->blue_player)
                                    {{ $game->blue_player->name }}
                                @else
                                    N/A
                                @endif
                                <br>
                                @if ($game->blue_player)
                                    {{ $game->blue_player->team->name }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="scoresheet-point-fontsize">{{ $game->scoresheet->blue_point }}</td>
                        </tr>
                    </table>
                </div>

                <div>
                    <strong>勝者</strong>
                    @if ($game->scoresheet && $game->scoresheet->victory_player)
                        <p>{{ $game->scoresheet->victory_player->name }}</p>
                    @else
                        N/A
                    @endif
                </div>

                <div>
                    <strong>勝因</strong>
                    @if ($game->scoresheet->victory_type)
                        {{ $game->scoresheet->victory_type->name }}
                    @else
                        N/A
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
