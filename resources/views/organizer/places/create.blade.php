<div>
    <h2>会場を追加</h2>
</div>

<form action="{{ route('organizer.places.store') }}" method="POST">
    @csrf
    <div>
        <strong>会場名</strong>
        <input type="text" name="name" id="name">
    </div>

    <div>
        <strong>会場の住所</strong>
        <input type="text" name="address" id="address">
    </div>

    <div>
        <button type="submit">送信</button>
    </div>
</form>
