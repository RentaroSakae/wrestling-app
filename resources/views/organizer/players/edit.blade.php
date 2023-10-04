<div>
    <h2>{{ $player->name }} 選手の情報を編集</h2>
</div>

<div>
    <a href="{{ route('organizer.players.index') }}">戻る</a>
</div>

<form action="{{ route('organizer.players.update', ['id' => $player->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <strong>氏名</strong>
        <input type="text" name="name" value="{{ $player->name }}" placeholder="Name">
    </div>

    <div>
        <button type="submit">更新</button>
    </div>
</form>
