<div>
    <h2>新しい大会を追加</h2>
</div>

<div>
    <a href="{{ route('organizer.competitions.index') }}">戻る</a>
</div>

<form action="{{ route('organizer.competitions.store') }}" method="POST">
    @csrf

    <div>
        <strong>大会名:</strong>
        <input type="text" name="name" id="Name">
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
        <strong>大会会場</strong>
        <select name="place" id="Place">
            @foreach ($places as $place)
                <option value="{{ $place->id }}">{{ $place->name }}</option>
            @endforeach
        </select>

    </div>

    <div>
        <button type="submit">送信</button>
    </div>
</form>
