<div>
    <h2>{{ $competitions->name }}のマットを追加</h2>
</div>

<div>
    <a href="{{ route('organizer.competitions.create') }}">大会作成ページに戻る</a>
</div>

<form action="{{ route('organizer.competitions.mats.store', ['id' => $competitions->id]) }}" method="POST">
    @csrf
    <div>
        <strong>大会</strong>
        <select name="competition_id" id="competition_id">
            <option value="{{ $competitions->id }}">{{ $competitions->name }}</option>
        </select>
    </div>
    <div>
        <strong>マット</strong>
        <input type="text" name="name" id="name">
    </div>

    <div>
        <button type="submit">送信</button>
    </div>
</form>
