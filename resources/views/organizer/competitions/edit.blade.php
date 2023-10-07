<div>
    <h2>大会を編集</h2>
</div>

<div>
    <a href="{{ route('home') }}">戻る</a>
</div>

<form action="{{ route('organizer.competitions.update', $competition->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <strong>大会名:</strong>
        <input type="text" name="name" value="{{ $competition->name }}" placeholder="Name">
    </div>
    <div>
        <strong>大会会場</strong>
        <input type="text" name="place" id="Place" value="{{ $places->name }}" placeholder="Place Name">
    </div>
    <div>
        <strong>大会開始日時</strong>
        <input type="data" name="start_at" id="Start_at" value="{{ $competition->start_at }}">
    </div>
    <div>
        <strong>大会終了日時</strong>
        <input type="data" name="close_at" id="Close_at" value="{{ $competition->close_at }}">
    </div>
    <div>
        <strong>大会画像</strong>
        <input type="image" name="image_path" id="Image_path" value="{{ $competition->image_path }}">
    </div>
    <div>
        <button type="submit">送信</button>
    </div>
</form>
