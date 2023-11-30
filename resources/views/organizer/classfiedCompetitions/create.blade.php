<div>
    <h2>{{ $competition->name }}・{{ $categoriezedCompetition->category->name }}の階級登録</h2>
</div>

<div>
    <a href="{{ route('organizer.competitions.index') }}">戻る</a>
</div>

<form
    action="{{ route('organizer.classfiedCompetitions.store', ['competition' => $competition->id, 'categoriezedCompetition' => $categoriezedCompetition->id]) }}"
    method="POST">
    @csrf
    <div>
        <strong>階級</strong>
        <select name="competition_class" id="Competition_class">
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
