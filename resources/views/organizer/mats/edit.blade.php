<div>
    <h2>{{ $competition->name }}のマットを編集</h2>
</div>

<div>
    <a href="{{ route('organizer.competitions.show', ['competition' => $competition->id]) }}">大会詳細ページに戻る</a>
</div>

<form action="{{ route('organizer.mats.update', ['competition' => $competition->id, 'mat' => $mat->id]) }}"
    method="POST">
    @method('PUT')
    @csrf
    <div>
        <strong>マット</strong>
        <input type="text" name="name" id="name" value="{{ $mat->name }}">
    </div>

    <div>
        <button type="submit">更新</button>
    </div>
</form>
