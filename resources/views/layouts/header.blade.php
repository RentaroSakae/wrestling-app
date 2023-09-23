<header>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mt-2 ms-3 me-3 shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">お気に入り</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">通知登録</a>
                    </li>

                    <!--ログイン・会員ボタン-->
                    <!--ログイン済みの場合-->
                    @auth
                    <div class="btn-group">
                        <button type="button" id="navbarDropdown" class="btn btn-primary dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">マイページ</a>
                            <a class="dropdown-item" href="#">設定</a>
                            
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>

                    <!--ログインしていない場合-->
                    @else
                    <a class="btn btn-primary" href="{{ route('login') }}">ログイン</a>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>