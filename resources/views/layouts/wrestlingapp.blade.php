<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/js/app.js'])

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
                <a href="{{ route('users.competitions.index') }}"
                    class="navbar-brand wrestlingapp-navber-right">Competitions</a>
                <a href="https://a-wrestler.com/" class="navbar-brand wrestlingapp-navber-right" target="_blank"
                    rel="noopener noreferrer">Blog</a>
                {{-- TODO 非ログイン時は「ログイン」、ログイン時は「MyPage」となるようにする --}}
                <button type="button" class="btn btn-outline-primary wrestlingapp-login-button">login</button>
            </div>
        </div>
    </nav>

    {{-- TODO ソート機能追加 --}}
    {{-- TODO 検索機能追加 --}}

    <div class="wrestlingapp-background">
        @yield('content')
    </div>




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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-39c0OYiFsj3Ayc0SYF4X3g3UAzmQ7IhU5K0sTjz13yI4sD3e4YgS2UqJ0LlqfV7F" crossorigin="anonymous">
    </script>
</body>

</html>
