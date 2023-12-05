<div>
    <h2>{{ $round->classfiedCompetition->categoriezed_competition->competition->name }}の大会スケジュール作成</h2>
</div>

<div>
    <h3>{{ $round->classfiedCompetition->categoriezed_competition->category->name }}・{{ $round->classfiedCompetition->competitionClass->style->name }}・{{ $round->classfiedCompetition->competitionClass->class }}のスケジュール登録
    </h3>
</div>

<form action="{{ route('organizer.schedules.store', ['competition' => $competition, 'round' => $round->id]) }}"
    method="POST">
    @csrf

    <div>
        <strong>マット</strong>
        <select name="mat_id" id="Mat_id">
            @foreach ($mats as $mat)
                <option value="{{ $mat->id }}">{{ $mat->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <strong>実施順</strong>
        <input type="number" name="order" id="Order">
    </div>

    <div>
        <strong>日付</strong>
        <input type="date" name="date" id="Date">
    </div>

    <div>
        <button type="submit">送信</button>
    </div>

</form>
