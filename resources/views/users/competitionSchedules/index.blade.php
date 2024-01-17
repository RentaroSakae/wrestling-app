@extends('layouts.wrestlingapp')

@section('title', '大会スケジュール')

@section('content')

    <div class="wrestlingapp-content d-flex justify-content-center" style="min-height: 100vh;">
        <div style="width: 100%">
            <div class="mb-3">
                <div>
                    <h2 class="fs-4 mt-5 d-flex justify-content-center">{{ $competition->name }}</h2>
                </div>
            </div>
            @php
                // 現在のリクエストから 'target' パラメータを取得
                $currentTarget = request('target');
            @endphp

            <div>
                <h3 class="fs-5 d-flex justify-content-center">- 大会スケジュール -</h2>
            </div>

            {{-- <div>
                <a
                    href="{{ route('users.matchOrders.index', ['competition' => $competition->id, 'target' => $currentTarget]) }}">マット別試合順</a>
            </div> --}}

            <div class="d-flex justify-content-center pt-3">
                @foreach ($dateRange as $date)
                    <a href="{{ route('users.competitionSchedules.index', ['competition' => $competition->id, 'mat' => $currentMat->id, 'target' => $date]) }}"
                        class="btn btn-outline-primary wrestlingapp-login-button {{ $targetDate == $date ? 'active' : '' }}">{{ $date }}</a>
                @endforeach
            </div>

            <div class="d-flex justify-content-center pt-3">
                @foreach ($mats as $mat)
                    <a href="{{ route('users.competitionSchedules.index', ['competition' => $competition->id, 'mat' => $mat->id, 'target' => $currentTarget]) }}"
                        class="btn btn-outline-primary wrestlingapp-login-button {{ $mat->id == $currentMat->id ? 'active' : '' }}">{{ $mat->name }}</a>
                @endforeach
            </div>
            <div class="wrestlingapp-table-witdh d-flex">
                @if ($targetDate)
                    @if ($schedules->isEmpty())
                        <p>スケジュールが登録されていません。</p>
                    @else
                        <table class="table m-4 text-center align-middle table-striped">
                            @forelse ($schedules as $key => $group)
                                @php
                                    // キーから日付とマット名を取得
                                    [$date, $matName] = explode(' ', $key, 2);
                                @endphp
                                @if ($date === $targetDate)
                                    <tr class="fs-5">
                                        <th class="px-2">カテゴリ</th>
                                        <th class="px-2">スタイル</th>
                                        <th class="px-2">階級</th>
                                        <th class="px-2">回戦</th>
                                        <th class="px-2">試合番号</th>
                                        <th class="px-2">試合数</th>
                                    </tr>
                                    @foreach ($group as $schedule)
                                        @if ($schedule->round && $schedule->round->classfiedCompetition)
                                            <tr class="wrestlingapp-row-height fs-6">
                                                <td class="px-2">
                                                    {{ $schedule->round->classfiedCompetition->categoriezed_competition->category->name }}
                                                </td>
                                                <td class="px-2">
                                                    {{ $schedule->round->classfiedCompetition->competitionClass->style->name }}
                                                </td>
                                                <td class="px-2">
                                                    {{ $schedule->round->classfiedCompetition->competitionClass->class }}kg級
                                                </td>
                                                <td class="px-2">{{ $schedule->round->title }}</td>
                                                <td class="px-2">
                                                    @php
                                                        $gameNumbers = $schedule->round->games->pluck('game_number');
                                                        $minGameNumber = $gameNumbers->min();
                                                        $maxGameNumber = $gameNumbers->max();
                                                    @endphp
                                                    {{ $minGameNumber }}〜{{ $maxGameNumber }}
                                                </td>
                                                <td class="px-2">{{ $schedule->round->games->count() }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            @empty
                                <tr>
                                    <th colspan="5">スケジュールが登録されていません。</th>
                                </tr>
                            @endforelse
                        </table>
                    @endif
                @endif
            </div>
            <div class="d-flex justify-content-center mt-5">
                <a href="{{ route('users.categoriezedCompetition.index', ['competition' => $competition->id, 'categoriezedCompetition' => $categoriezedCompetition->id]) }}"
                    class="btn btn-outline-primary wrestlingapp-login-button justify-content-center">詳細に戻る</a>
            </div>
        </div>
    </div>
@endsection
