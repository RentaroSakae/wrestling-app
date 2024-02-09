@extends('layouts.wrestlingapp')

@section('title', '出場選手一覧')

@section('content')

    <div class="wrestlingapp-content d-flex justify-content-center" style="min-height: 100vh;">
        <div class="container mt-3">
            <div>
                <h3 class="fs-5 d-flex justify-content-center">- お気に入り選手 -</h3>
            </div>
            {{-- PC用 --}}
            <div class="wrestlingapp-table-width d-flex justify-content-center d-none d-md-block">
                <table class="table m-4 text-center align-middle table-striped ">
                    <thead>
                        <tr class="fs-5 table-sp">
                            <th class="px-2">選手名</th>
                            <th class="px-2">所属チーム</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($favoritePlayers as $favoritePlayer)
                            <tr class="fs-6 table-sp">
                                <td class="px-2">{{ $favoritePlayer->player->name }}</td>
                                <td class="px-2">{{ $favoritePlayer->player->team->name }}</td>
                                <td class="px-2"><a
                                        href="{{ route('users.favoritePlayerGames.index', [$favoritePlayer->player->id]) }}"
                                        class="btn btn-outline-primary wrestlingapp-class-button table-sp">試合情報</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- スマホ用 --}}
            <div class="mt-5">
                @foreach ($favoritePlayers as $favoritePlayer)
                    <div class="list-group d-block d-md-none mt-3 mb-2 macthorder-list">
                        {{-- 上の行 --}}
                        <div class="list-upper-content mb-3 d-flex pt-2">
                            <div class="flex-fill text-center">
                                {{ $favoritePlayer->player->name }}
                            </div>
                            <div class="flex-fill text-center">
                                {{ $favoritePlayer->player->team->name }}
                            </div>
                        </div>
                        {{-- 下の行 --}}
                        <div class="list-lower-content mb-2 d-flex justify-content-center">
                            <a href="{{ route('users.favoritePlayerGames.index', [$favoritePlayer->player->id]) }}"
                                class="btn btn-outline-primary wrestlingapp-class-button competition-information-btn">試合情報</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-5">
                <a href="{{ route('users.users.index') }}"
                    class="btn btn-outline-primary wrestlingapp-class-button justify-content-center">マイページに戻る</a>
            </div>
        </div>
    </div>
@endsection
