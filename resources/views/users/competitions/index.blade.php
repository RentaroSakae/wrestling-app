<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A WRESTLER. 大会一覧</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>



<link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">

<body>
    {{-- 全ページ共通 --}}
    <nav class="navbar bg-body-tertiary wrestlingapp-navbar">
        <div class="container-fluid">
            <div>
                {{-- TODO ロゴ画像変更する --}}
                <a class="navbar-brand" href="{{ route('users.competitions.index') }}">
                    <img src="{{ asset('image/logo.png') }}" alt="A WRESTLER." width="100%" height="100%">
                </a>
            </div>
            <div>
                <a href="{{ route('users.competitions.index', ['target' => 'current']) }}"
                    class="navbar-brand wrestlingapp-navber-right">Ongoing</a>
                <a href="{{ route('users.competitions.index', ['target' => 'future']) }}"
                    class="navbar-brand wrestlingapp-navber-right">Up-coming</a>
                <a href="{{ route('users.competitions.index', ['target' => 'past']) }}"
                    class="navbar-brand wrestlingapp-navber-right">Past</a>
                {{-- TODO 非ログイン時は「ログイン」、ログイン時は「MyPage」となるようにする --}}
                <button type="button" class="btn btn-outline-primary wrestlingapp-login-button">login</button>
            </div>
        </div>
    </nav>

    {{-- TODO ソート機能追加 --}}
    {{-- TODO 検索機能追加 --}}

    <div class="wrestlingapp-background">
        <div class="wrestlingapp-content justify-content-center">
            <div class="wrestlingapp-table-witdh d-flex">
                <table class="table m-4 text-center align-middle">
                    <thead>
                        <tr class="fs-4">
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
                                <tr class="wrestlingapp-row-height fs-5">
                                    <td class="px-2">{{ $categoriezedCompetition->start_at }} 〜
                                        {{ $categoriezedCompetition->close_at }}
                                    </td>
                                    <td class="px-2">{{ $categoriezedCompetition->competition->name }}</td>
                                    <td class="px-2">{{ $categoriezedCompetition->competition->place->name }}</td>
                                    <td class="px-2">{{ $categoriezedCompetition->category->name }}</td>
                                    <td class="px-2">
                                        <a
                                            href="{{ route('users.categoriezedCompetition.index', ['competition' => $categoriezedCompetition->competition->id, 'categoriezedCompetition' => $categoriezedCompetition->id]) }}">詳細</a>
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
        </div>
    </div>
</body>

{{-- 全ページ共通 --}}
<footer class="d-flex justify-content-center align-items-center wrestlingapp-footer">
    <div>
        {{-- TODO ロゴ画像変更する --}}
        <a class="navbar-brand" href="{{ route('users.competitions.index') }}">
            <img src="{{ asset('image/logo.png') }}" alt="A WRESTLER." width="100%" height="100%">
        </a>
        <p class="text-center text-white small">&copy; A WRESTLER. All rights reserved.</p>
    </div>
</footer>

</html>
