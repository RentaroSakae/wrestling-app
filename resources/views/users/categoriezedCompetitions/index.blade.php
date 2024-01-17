@extends('layouts.wrestlingapp')

@section('title', '大会の詳細')

@section('content')

    <div class="wrestlingapp-content d-flex justify-content-center" style="min-height: 100vh;">
        <div class="">
            <div class="mb-3">
                <div>
                    <h2 class="fs-4 mt-5 d-flex justify-content-center">{{ $competition->name }}</h2>
                </div>
            </div>

            <div>
                <div>
                    <h3 class="fs-5 d-flex justify-content-center">- 出場選手 -</h2>
                </div>
                <div>
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        @php
                            $styles = collect($classes)
                                ->mapWithKeys(function ($class) {
                                    return [$class->competitionClass->style->id => $class->competitionClass->style->name];
                                })
                                ->unique();
                        @endphp

                        @foreach ($styles as $styleId => $styleName)
                            <li class="nav-item wrestlingapp-tab" role="presentation">
                                <button class="wrestlingapp-class-button nav-link {{ $loop->first ? 'active' : '' }}"
                                    id="style-tab-{{ $styleId }}" data-bs-toggle="tab"
                                    data-bs-target="#style-tab-pane-{{ $styleId }}" type="button" role="tab"
                                    aria-controls="style-tab-pane-{{ $styleId }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $styleName }}</button>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content categorized-box" id="myTabContent">
                        @foreach ($styles as $styleId => $styleName)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="style-tab-pane-{{ $styleId }}" role="tabpanel"
                                aria-labelledby="style-tab-{{ $styleId }}" tabindex="0">
                                @foreach ($classes as $class)
                                    @if ($class->competitionClass->style->id == $styleId)
                                        <a href="{{ route('users.classfiedCompetitionPlayers.index', [
                                            'competition' => $competition->id,
                                            'categoriezedCompetition' => $categoriezedCompetition->id,
                                            'classfiedCompetition' => $class->id,
                                        ]) }}"
                                            class="a-tag">{{ $class->competitionClass->class }}kg級</a>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h3 class="fs-5 d-flex justify-content-center mt-5">- 進行・スケジュール -</h3>
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-column justify-centent-center">
                            @foreach ($mats as $mat)
                                <a href="{{ route('users.competitionSchedules.index', ['competition' => $mat->competition->id, 'mat' => $mat->id]) }}"
                                    class="mb-2 text-center a-tag-yellow">{{ $mat->name }}</a>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex flex-column justify-centent-center">
                        <a href="{{ route('users.matchOrders.index', ['competition' => $competition->id]) }}"
                            class="text-center a-tag-yellow">対戦表・試合結果</a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <a href="{{ route('users.competitions.index') }}"
                    class="btn btn-outline-primary wrestlingapp-login-button justify-content-center">大会一覧に戻る</a>
            </div>
        </div>
    </div>
@endsection
