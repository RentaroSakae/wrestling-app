<div>
    <h2>{{ $competition->name }}の詳細</h2>
</div>

<div>
    <a href="{{ route('organizer.competitions.index') }}">戻る</a>
</div>


<table>
    <tr>
        <th>登録中のマット</th>
    </tr>
    @if (count($mats) > 0)
        @foreach ($mats as $mat)
            <tr>
                <td>{{ $mat->name }}</td>
                <td>
                    <a
                        href="{{ route('organizer.mats.edit', ['competition' => $competition->id, 'mat' => $mat->id]) }}">編集</a>

                </td>
                <td>
                    <form
                        action="{{ route('organizer.mats.destroy', ['competition' => $competition->id, 'mat' => $mat->id]) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    @else
        <p>登録中のマットはありません。</p>
    @endif
</table>

<div>
    <a href="{{ route('organizer.mats.create', ['competition_id' => $competition->id]) }}">マットを登録する</a>
</div>

<div>
    <h3>登録中のカテゴリ・スタイル・階級</h3>
</div>

<div>
    <a href="{{ route('organizer.categoriezedCompetitions.create', ['competition' => $competition->id]) }}">カテゴリを登録する</a>
</div>

@foreach ($categoriezedCompetitions as $categoriezedCompetition)
    <h3>{{ $categoriezedCompetition->category->name }}（{{ $categoriezedCompetition->start_at }}〜{{ $categoriezedCompetition->close_at }}）
    </h3>
    <div>
        <a
            href="{{ route('organizer.classfiedCompetitions.create', ['competition' => $competition->id, 'categoriezedCompetition' => $categoriezedCompetition->id]) }}">スタイル・階級を登録</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>スタイル</th>
                <th>階級</th>
                <th>開始日時</th>
                <th>終了日時</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categoriezedCompetition->classfiedCompetitions as $classfiedCompetition)
                <tr>
                    <td>{{ $classfiedCompetition->competitionClass->style->name }}</td>
                    <td>{{ $classfiedCompetition->competitionClass->class }}</td>
                    <td>{{ $categoriezedCompetition->start_at }}</td>
                    <td>{{ $categoriezedCompetition->close_at }}</td>
                    <td><a
                            href="{{ route('organizer.rounds.create', ['classfiedCompetition' => $classfiedCompetition->id]) }}">ラウンド作成</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach












{{-- <table>
    <tr>
        <th>スタイル</th>
        <th>階級</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    @if (count($classfiedCompetitions) > 0)
        @foreach ($classfiedCompetitions as $classfiedCompetition)
            <tr>
                <td>{{ $classfiedCompetition->categoriezed_competition->category->name }}</td>
                <td>{{ $classfiedCompetition->competition_class->style->name }}</td>
                <td>{{ $classfiedCompetition->competition_class->class }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="5">登録中のカテゴリ・スタイル・階級はありません。</td>
        </tr>
    @endif
</table> --}}
