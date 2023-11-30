<div>
    <h2>{{ $competition->name }}のカテゴリ登録</h2>
</div>

<div>
    <a href="{{ route('organizer.competitions.index') }}">戻る</a>
</div>

<form action="{{ route('organizer.categoriezedCompetitions.store', ['competition' => $competition->id]) }}"
    method="POST">
    @csrf
    <div>
        <strong>カテゴリ</strong>
        <select name="category" id="Category">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <strong>大会開始日時</strong>
        <input type="date" name="start_at" id="Start_at">
    </div>
    <div>
        <strong>大会終了日時</strong>
        <input type="date" name="close_at" id="Close_at">
    </div>

    <div>
        <button type="submit">送信</button>
    </div>

</form>
