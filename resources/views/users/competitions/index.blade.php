<link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">


<div>
    <a href="{{ route('users.competitions.index', ['target' => 'current']) }}">現在開催中の大会</a>
    <a href="{{ route('users.competitions.index', ['target' => 'future']) }}">近日開催予定の大会</a>
    <a href="{{ route('users.competitions.index', ['target' => 'past']) }}">過去に開催された大会</a>
</div>

{{-- TODO ソート機能追加 --}}
{{-- TODO 検索機能追加 --}}

<table>
    <tr>
        <th></th>
        <th>大会日時</th>
        <th>大会名</th>
        <th>大会会場</th>
        <th>カテゴリ</th>

    </tr>
    @if (count($categoriezedCompetitions) > 0)
        @foreach ($categoriezedCompetitions as $categoriezedCompetition)
            <tr>
                <td>
                    @auth <!-- ログインしているかチェック -->
                        @if ($categoriezedCompetition->isFavoritedBy(Auth::user()))
                            <!-- お気に入り登録済みの場合 -->
                            <form
                                action="{{ route('users.categoriezedCompetitions.unfavorite', ['competition' => $categoriezedCompetition->competition->id, 'categoriezedCompetition' => $categoriezedCompetition->id]) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                                    <i class="fas fa-star"></i>
                                </button>
                            </form>
                        @else
                            <!-- お気に入り未登録の場合 -->
                            <form
                                action="{{ route('users.categoriezedCompetitions.favorite', ['competition' => $categoriezedCompetition->id, 'categoriezedCompetition' => $categoriezedCompetition->id]) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                                    <i class="far fa-star"></i>
                                </button>
                            </form>
                        @endif
                    @else
                        <!-- ログインしていないユーザーの場合 -->
                        <a href="{{ route('login') }}">
                            <i class="far fa-star"></i>
                        </a>
                    @endauth
                </td>
                <td>{{ $categoriezedCompetition->start_at }} 〜 {{ $categoriezedCompetition->close_at }}</td>
                <td>{{ $categoriezedCompetition->competition->name }}</td>
                <td>{{ $categoriezedCompetition->competition->place->name }}</td>
                <td>{{ $categoriezedCompetition->category->name }}</td>
                <td>
                    <a
                        href="{{ route('users.categoriezedCompetition.index', ['competition' => $categoriezedCompetition->competition->id, 'categoriezedCompetition' => $categoriezedCompetition->id]) }}">詳細</a>
                </td>
            </tr>
            {{-- TODO ページドネーション追加 --}}
        @endforeach
    @else
        <tr>
            <td colspan="6">該当する大会がありません。</td>
        </tr>
    @endif

</table>
