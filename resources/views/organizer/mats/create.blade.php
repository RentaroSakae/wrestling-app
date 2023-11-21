<div>
    <h2>{{ $competition->name }}のマットを追加</h2>
</div>

<div>
    <a href="{{ route('organizer.competitions.create') }}">大会作成ページに戻る</a>
</div>

<form action="{{ route('organizer.mats.store', ['competition_id' => $competition->id]) }}" method="POST">
    @csrf
    <div>
        <strong>マット</strong>
        <input type="text" name="name" id="name">
    </div>

    <div>
        <button type="submit">送信</button>
    </div>
</form>
