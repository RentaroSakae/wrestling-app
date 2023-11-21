<div>
    <h2>{{ $competition->name }}・{{ $competition->category->name }}のカテゴリ・スタイル・階級登録</h2>
</div>

<div>
    <a href="{{ route('organizer.competitions.show', ['competition' => $competition->id]) }}">戻る</a>
</div>

<form action="{{ route('organizer.competitionStyleClasses.store', ['competition' => $competition->id]) }}" method="POST">
    @csrf

    {{-- <div>
        <strong>カテゴリ</strong>
        <select name="category" id="Category">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div> --}}

    <div>
        <strong>階級</strong>
        <select name="competitionClass" id="CompetitionClass">
            @foreach ($competitionClasses as $competitionClass)
                <option value="{{ $competitionClass->id }}">
                    {{ $competitionClass->style->name }}・{{ $competitionClass->class }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit">送信</button>
    </div>
</form>
