@extends('layouts.wrestlingapp')

@section('title', 'スコアシート')

@section('content')

    <div class="wrestlingapp-content scoresheet-container scoresheet-container-sp" style="min-height: 100vh;">
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
                    {{-- PC用テーブル --}}
                    <div class="d-none d-md-block">
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
                    {{-- スマホ用テーブル --}}
                    <div class="d-flex d-block d-md-none">
                        <table class="table table-borderless m-4 text-center align-middle justify-content-center">
                            <tr>
                                <th>日付</th>
                                <td>{{ $competitionSchedule->date }}</td>
                            </tr>
                            <tr>
                                <th>マット</th>
                                <td>{{ $competitionSchedule->mat->name }}</td>
                            </tr>
                            <tr>
                                <th>カテゴリー</th>
                                <td>{{ $categoriezedCompetition->category->name }}</td>
                            </tr>
                            <tr>
                                <th>スタイル</th>
                                <td>{{ $classfiedCompetition->competitionClass->style->name }}</td>
                            </tr>
                            <tr>
                                <th>階級</th>
                                <td>{{ $classfiedCompetition->competitionClass->class }}kg級</td>
                            </tr>
                            <tr>
                                <th>回戦</th>
                                <td>{{ $game->round->title }}</td>
                            </tr>
                        </table>

                    </div>

                </div>
                <div class="justify-content-between text-center">
                    {{-- ↓aroundが機能していない？ --}}
                    <div class="row">
                        <table class="col table scoresheet-red-border mx-3 scoresheet-table">
                            <tr>
                                <th class="fs-6 red-background">RED 赤</th>
                            </tr>
                            <tr>
                                <td class="fs-6 scoresheet-name-sp">
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

                        <table class="col table table-bordered scoresheet-blue-border mx-3 scoresheet-table">
                            <tr>
                                <th class="fs-6 blue-background">BLUE 青</th>
                            </tr>
                            <tr>
                                <td class="fs-6 scoresheet-name-sp">
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

                    <div class="d-flex justify-content-center">
                        <table class="table table-bordered text-center scoresheet-table">
                            <tr>
                                <th class="fs-6 winner-background">勝者</th>
                            </tr>
                            <tr>
                                <td>
                                    @if ($game->scoresheet && $game->scoresheet->victory_player)
                                        <p>{{ $game->scoresheet->victory_player->name }}</p>
                                    @else
                                        N/A
                                    @endif
                                    <br>
                                    @if ($game->scoresheet->victory_type)
                                        {{ $game->scoresheet->victory_type->name }}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                {{-- <strong>勝者</strong>
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
                    @endif --}}
                <div class="d-flex justify-content-center mt-5 mb-3">
                    {{-- TODO 試合一覧画面に戻れるようにする --}}
                    <a href="{{ route('users.matchOrders.index', ['competition' => $competition->id]) }}"
                        class="btn btn-outline-primary wrestlingapp-class-button justify-content-center">試合一覧に戻る</a>
                </div>
            </div>
        </div>
    </div>
@endsection
