@extends('layouts.wrestlingapp')

@section('title', '出場選手一覧')

@section('content')

    <div class="wrestlingapp-content d-flex justify-content-center">
        <div style="width: 100%">
            <div class="mb-3">
                <div>
                    <h2 class="fs-4 mt-5 d-flex justify-content-center">{{ $competition->name }}</h2>
                </div>
            </div>
            <div>
                <h3 class="fs-5 d-flex justify-content-center">- 出場選手 -</h2>
            </div>

            <div>
                <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
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

                <ul class="tab-content d-flex justify-content-center" id="myTabContent">
                    @foreach ($styles as $styleId => $styleName)
                        <li class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                            id="style-tab-pane-{{ $styleId }}" role="tabpanel"
                            aria-labelledby="style-tab-{{ $styleId }}" tabindex="0">
                            @foreach ($classes as $class)
                                @php
                                    $selected = $class->id == $classfiedCompetition->id;

                                @endphp

                                @if ($class->competitionClass->style->id == $styleId)
                                    <a href="{{ route('users.classfiedCompetitionPlayers.index', [
                                        'competition' => $competition->id,
                                        'categoriezedCompetition' => $categoriezedCompetition->id,
                                        'classfiedCompetition' => $class->id,
                                    ]) }}"
                                        class="wrestlingapp-class-button {{ $selected ? 'active' : '' }}">{{ $class->competitionClass->class }}kg級</a>
                                @endif
                            @endforeach
                        </li>
                    @endforeach
                </ul>


                {{-- <div class="tab-content" id="myTabContent">
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
                </div> --}}
            </div>
            @php
                $user = Auth::user();
            @endphp
            <table class="d-flex justify-content-center">
                @foreach ($players as $player)
                    <tr>
                        <td>{{ $player->player->name }}</td>
                        <td>{{ $player->player->team->name }}</td>
                        <td>


                        <td>
                            @if (Auth::check())
                                @if (Auth::user()->favorite_classfiedCompetitionPlayers()->where('classfied_competition_player_id', $player->id)->exists())
                                    <form id="favorites-destroy-form"
                                        action="{{ route('user.favorites.destroy', $player->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-primary wrestlingapp-login-button">
                                            お気に入り解除
                                        </button>
                                    </form>
                                @else
                                    <form id="favorites-store-form"
                                        action="{{ route('user.favorites.store', $player->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary wrestlingapp-login-button">
                                            お気に入り
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary wrestlingapp-login-button">
                                    ログインしてお気に入り機能を使用
                                </a>
                            @endif
                        </td>







                        {{-- @if (Auth::check())

                                @if (Auth::user()->favorite_classfiedCompetitionPlayers()->where('classfied_competition_player_id', $player->id)->exists())
                                    <a href="{{ route('user.favorites.destroy', $player->id) }}"
                                        class="btn btn-outline-primary wrestlingapp-login-button"
                                        onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();">
                                        お気に入り解除
                                    </a>
                                @else
                                    <a href="{{ route('user.favorites.store', $player->id) }}"
                                        class="btn btn-outline-primary wrestlingapp-login-button"
                                        onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();">
                                        お気に入り
                                    </a>
                                @endif
                            @else
                                <form id="favorites-destroy-form"
                                    action="{{ route('users.favorites.destroy', $player->id) }}" method="POST"
                                    class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <form id="favorites-store-form" action="{{ route('users.favorites.store', $player->id) }}"
                                    method="POST" class="d-none">
                                    @csrf
                                </form>

                                <a href="{{ route('login') }}"
                                    class="btn btn-outline-primary wrestlingapp-login-button">>ログインしてお気に入り機能を使用</a>
                            @endif --}}
                        </td>
                        {{-- TODO 試合結果 --}}
                    </tr>
                @endforeach
            </table>


            <div class="d-flex justify-content-center mt-5">
                <a
                    href="{{ route('users.categoriezedCompetition.index', ['competition' => $competition->id, 'categoriezedCompetition' => $categoriezedCompetition->id]) }}">詳細に戻る</a>
            </div>
        </div>
    </div>
@endsection















{{-- <div>
    <h2>{{ $competition->name }}の選手一覧</h2>
</div>

<div>
    <a
        href="{{ route('users.competition-players.index', ['competition_id' => $competition_id, 'target' => 'freestyle']) }}">フリースタイル</a>
    <a
        href="{{ route('users.competition-players.index', ['competition_id' => $competition_id, 'target' => 'grecoroman']) }}">グレコローマン</a>
    <a
        href="{{ route('users.competition-players.index', ['competition_id' => $competition_id, 'target' => 'woman']) }}">女子</a>
</div>

<div>
    @foreach ($competitionClasses as $competitionClass)
        @if ($target === 'freestyle')
            <a
                href="{{ route('users.competition-players.index', ['competition_id' => $competition_id, 'target' => 'freestyle', 'competition_class' => $competitionClass->id]) }}">{{ $competitionClass->class }}kg級</a>
        @elseif ($target === 'grecoroman')
            <a
                href="{{ route('users.competition-players.index', ['competition_id' => $competition_id, 'target' => 'grecoroman', 'competition_class' => $competitionClass->id]) }}">{{ $competitionClass->class }}kg級</a>
        @elseif ($target === 'woman')
            <a
                href="{{ route('users.competition-players.index', ['competition_id' => $competition_id, 'target' => 'woman', 'competition_class' => $competitionClass->id]) }}">{{ $competitionClass->class }}kg級</a>
        @else
            <a
                href="{{ route('users.competition-players.index', ['competition_id' => $competition_id, 'target' => 'freestyle', 'competition_class' => $competitionClass->id]) }}">{{ $competitionClass->class }}kg級</a>
        @endif
    @endforeach
</div>

<div>
    <table>
        <tr>
            <th>選手名</th>
            <th>所属</th>
        </tr>
        @foreach ($competitionPlayers as $competitionPlayer)
            @if ($competitionPlayer->competition_class_id == request('competition_class'))
                <tr>
                    <td>{{ $competitionPlayer->player->name }}</td>
                    <td>{{ $competitionPlayer->player->team->name }}</td>
                    {{-- TODO「通知登録」ボタンを設置
                </tr>
            @endif
        @endforeach
    </table>
</div> --}}
