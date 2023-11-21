<div>
    <h2>{{ $competition->name }}・{{ $competition->category->name }}の詳細</h2>
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

<table>
    <tr>
        <th colspan="3">登録中のスタイル・階級</th>
    </tr>
    <tr>
        <th>スタイル</th>
        <th>階級</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    @if (count($styleClasses) > 0)
        @foreach ($styleClasses as $styleClass)
            <tr>
                <td>{{ $styleClass->competitionClass->style->name }}</td>
                <td>{{ $styleClass->competitionClass->class }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="5">登録中のカテゴリ・スタイル・階級はありません。</td>
        </tr>
    @endif
</table>

<div>
    <a href="{{ route('organizer.mats.create', ['competition_id' => $competition->id]) }}">マットを登録する</a>
</div>
<div>
    <a
        href="{{ route('organizer.competitionStyleClasses.create', ['competition' => $competition->id]) }}">カテゴリ・スタイル・階級を登録する</a>
</div>
