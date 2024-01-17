@extends('layouts.wrestlingapp')

@section('title', '大会スケジュール')

@section('content')

    <div class="wrestlingapp-content d-flex justify-content-center">
        <div>
            <div class="mb-3">
                <div>
                    <h2 class="fs-4 mt-5 d-flex justify-content-center">{{ $competition->name }}</h2>
                </div>
            </div>

            <div>
                <h3 class="fs-5 d-flex justify-content-center">- 試合順 -</h2>
            </div>
            @php
                $currentDate = request('targetDate') ?? $targetDate;
                $currentMat = request('targetMat') ?? $targetMat;
            @endphp


            <div class="d-flex justify-content-center pt-3">
                @foreach ($dateRange as $date)
                    <a href="{{ route('users.matchOrders.index', [
                        'competition' => $competition->id,
                        'targetDate' => $date,
                        'targetMat' => $currentMat ?? $targetMat,
                    ]) }}"
                        class="btn btn-outline-primary wrestlingapp-login-button {{ $currentDate == $date ? 'active' : '' }}">{{ $date }}</a>
                @endforeach
            </div>

            <div class="d-flex justify-content-center pt-3">
                @foreach ($mats as $matItem)
                    <a href="{{ route('users.matchOrders.index', [
                        'competition' => $competition->id,
                        'targetDate' => $currentDate ?? $targetDate,
                        'targetMat' => $matItem->id,
                    ]) }}"
                        class="btn btn-outline-primary wrestlingapp-login-button {{ $currentMat == $matItem->id ? 'active' : '' }}">{{ $matItem->name }}</a>
                @endforeach
            </div>

            <div class="wrestlingapp-table-witdh d-flex">
                <table class="table m-4 text-center align-middle table-striped">
                    <tr class="fs-5">
                        <th class="px-2">試合番号</th>
                        <th class="px-2">カテゴリ</th>
                        <th class="px-2">スタイル</th>
                        <th class="px-2">階級</th>
                        <th class="px-2">回戦</th>
                        <th class="px-2">赤コーナー</th>
                        <th class="px-2"></th>
                        <th class="px-2">得点（赤）</th>
                        <th class="px-2"></th>
                        <th class="px-2">得点（青）</th>
                        <th class="px-2"></th>
                        <th class="px-2">青コーナー</th>
                        <th class="px-2"></th>
                    </tr>
                    @foreach ($schedules as $schedule)
                        @php $currentGameNumber = $schedule->totalGamesBefore @endphp
                        @if ($schedule->round && $schedule->round->games->isNotEmpty())
                            @foreach ($schedule->round->games as $game)
                                <tr class="wrestlingapp-row-height fs-6">
                                    <td class="px-2">{{ ++$currentGameNumber }}</td>
                                    <td class="px-2">
                                        {{ $schedule->round->classfiedCompetition->categoriezed_competition->category->name }}
                                    </td>
                                    <td class="px-2">
                                        {{ $schedule->round->classfiedCompetition->competitionClass->style->name }}</td>
                                    <td class="px-2">
                                        {{ $schedule->round->classfiedCompetition->competitionClass->class }}</td>
                                    <td class="px-2">{{ $schedule->round->title }}</td>
                                    <td class="px-2">{{ $game->red_player->name ?? 'N/A' }}</td>
                                    <td class="px-2">
                                        @if (optional($game->scoresheet)->victory_player_id === $game->red_player_id)
                                            ●
                                        @endif
                                    </td>
                                    <td class="px-2">{{ optional($game->scoresheet)->red_point }}</td>
                                    <td class="px-2">-</td>
                                    <td class="px-2">{{ optional($game->scoresheet)->blue_point }}</td>
                                    <td class="px-2">
                                        @if (optional($game->scoresheet)->victory_player_id === $game->blue_player_id)
                                            ●
                                        @endif
                                    </td>
                                    <td class="px-2">{{ $game->blue_player->name ?? 'N/A' }}</td>
                                    <td class="px-2">
                                        <a href="{{ route('users.scoresheets.show', ['competition' => $competition->id, 'categoriezedCompetition' => $game->round->classfiedCompetition->categoriezed_competition->id, 'classfiedCompetition' => $game->round->classfiedCompetition->id, 'game' => $game->id]) }}"
                                            class="btn btn-outline-primary wrestlingapp-login-button">スコアシート</a>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- @else
            <tr>
                <td colspan="12">このスケジュールにはゲームが登録されていません。</td>
            </tr> --}}
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
