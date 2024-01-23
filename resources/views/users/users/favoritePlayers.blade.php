@extends('layouts.wrestlingapp')

@section('title', '出場選手一覧')

@section('content')

    <div class="wrestlingapp-content d-flex justify-content-center" style="min-height: 100vh;">
        <div class="container mt-3">
            <div>
                <h3 class="fs-5 d-flex justify-content-center">- 登録選手 -</h3>
            </div>

            <div class="wrestlingapp-table-witdh d-flex justify-content-center">
                <table class="table m-4 text-center align-middle table-striped">
                    <thead>
                        <tr class="fs-5">
                            <th class="px-2">選手名</th>
                            <th class="px-2">所属チーム</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($favoritePlayers as $favoritePlayer)
                            <tr class="fs-6">
                                <td class="px-2">{{ $favoritePlayer->player->name }}</td>
                                <td class="px-2">{{ $favoritePlayer->player->team->name }}</td>
                                <td class="px-2"><a
                                        href="{{ route('users.favoritePlayerGames.index', [$favoritePlayer->player->id]) }}"
                                        class="btn btn-outline-primary wrestlingapp-login-button">試合情報</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <a href="{{ route('users.users.index') }}"
                    class="btn btn-outline-primary wrestlingapp-login-button justify-content-center">マイページに戻る</a>
            </div>
        </div>
    </div>
@endsection
