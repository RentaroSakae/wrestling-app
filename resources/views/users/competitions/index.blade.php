@extends('layouts.wrestlingapp')

@section('title', '大会一覧')

@section('content')

    {{-- TODO ソート機能追加 --}}
    {{-- TODO 検索機能追加 --}}


    <div class="wrestlingapp-content justify-content-center">
        <div class="d-flex justify-content-center pt-3">
            <a href="{{ route('users.competitions.index', ['target' => 'current']) }}"
                class="btn btn-outline-primary wrestlingapp-login-button {{ request()->get('target') == 'current' ? 'active' : '' }}">
                Ongoing
            </a>
            <a href="{{ route('users.competitions.index', ['target' => 'future']) }}"
                class="btn btn-outline-primary wrestlingapp-login-button {{ request()->get('target') == 'future' ? 'active' : '' }}">
                Up-coming
            </a>
            <a href="{{ route('users.competitions.index', ['target' => 'past']) }}"
                class="btn btn-outline-primary wrestlingapp-login-button {{ request()->get('target') == 'past' ? 'active' : '' }}">
                Past
            </a>
        </div>
        <div class="wrestlingapp-table-witdh d-flex">
            <table class="table m-4 text-center align-middle table-striped">
                <thead>
                    <tr class="fs-5">
                        <th class="px-2">大会日時</th>
                        <th class="px-2">大会名</th>
                        <th class="px-2">大会会場</th>
                        <th class="px-2">カテゴリ</th>
                        <th></th>
                    </tr>
                </thead>
                @if (count($categoriezedCompetitions) > 0)
                    @foreach ($categoriezedCompetitions as $categoriezedCompetition)
                        <tbody>
                            {{-- TODO 行全体をaタグにする、hover時に色が変わるようにする --}}
                            <tr class="wrestlingapp-row-height fs-6">
                                <td class="px-2">{{ $categoriezedCompetition->start_at }} 〜
                                    {{ $categoriezedCompetition->close_at }}
                                </td>
                                <td class="px-2">{{ $categoriezedCompetition->competition->name }}</td>
                                <td class="px-2">{{ $categoriezedCompetition->competition->place->name }}
                                </td>
                                <td class="px-2">{{ $categoriezedCompetition->category->name }}</td>
                                <td class="px-2">
                                    <a href="{{ route('users.categoriezedCompetition.index', ['competition' => $categoriezedCompetition->competition->id, 'categoriezedCompetition' => $categoriezedCompetition->id]) }}"
                                        class="btn btn-outline-primary wrestlingapp-login-button">詳細</a>
                                </td>
                            </tr>

                            {{-- TODO ページドネーション追加 --}}
                        </tbody>
                    @endforeach
                @else
                    <tr class="fs-5">
                        <td colspan="6">該当する大会がありません。</td>
                    </tr>
                @endif

            </table>

        </div>
    @endsection
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-39c0OYiFsj3Ayc0SYF4X3g3UAzmQ7IhU5K0sTjz13yI4sD3e4YgS2UqJ0LlqfV7F" crossorigin="anonymous">
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var links = document.querySelectorAll('.wrestlingapp-login-button');

            links.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    // event.preventDefault(); // デフォルトのナビゲーションを防止

                    // すべてのリンクからクラスを削除
                    links.forEach(function(el) {
                        el.classList.remove('active-link');
                    });

                    // クリックされたリンクにクラスを追加
                    this.classList.add('active-link');
                });
            });
        });
    </script>



    {{-- 全ページ共通 --}}
    {{-- <footer class="d-flex justify-content-center align-items-center wrestlingapp-footer">
        <div>

            <a class="navbar-brand" href="{{ route('users.competitions.index') }}">
                <img src="{{ asset('image/logo.png') }}" alt="A WRESTLER." width="100%" height="100%">
            </a>
            <p class="text-center text-white small">&copy; A WRESTLER. All rights reserved.</p>
        </div>
    </footer>

    </html> --}}
