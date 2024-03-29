@extends('layouts.wrestlingapp')

@section('title', 'マイページ')

@section('content')

    <div class="wrestlingapp-content d-flex justify-content-center" style="min-height: 100vh;">
        <div>
            <div class="mb-3 mt-3">
                <h3 class="fs-5 d-flex justify-content-center">- マイページ -</h2>
            </div>
            <div class="d-flex flex-column justify-centent-center">
                <div class="d-flex flex-column justify-centent-center mb-3">
                    <a href="{{ route('users.users.favoritePlayers') }}"
                        class="btn btn-outline-primary wrestlingapp-class-button justify-content-center">お気に入り登録中の選手一覧</a>
                </div>

                <div class="d-flex flex-column justify-centent-center mb-3">
                    <a href="#"
                        class="btn btn-outline-primary wrestlingapp-class-button justify-content-center">個人情報変更</a>
                </div>
                <div class="d-flex flex-column justify-centent-center mb-3">
                    <a class="btn btn-outline-primary wrestlingapp-class-button justify-content-center"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <a href="{{ route('users.competitions.index') }}"
                    class="btn btn-outline-primary wrestlingapp-class-button justify-content-center">大会一覧に戻る</a>
            </div>

        </div>
    </div>
@endsection
