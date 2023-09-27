<div>
    <h2>新しい大会を追加</h2>
</div>

<div>
    <a href="{{ route('competitions.index') }}">戻る</a>
</div>

<form action="{{ route('competitions.store') }}" method="POST">
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
            @foreach($places as $place)
            <option value="{{ $place->id }}">{{ $place->name }}</option>
            @endforeach
        </select>

    </div>
    <div>
        <strong>カテゴリ（複数選択可）</strong>
        @include('modals.add_competitionCategory')
        <div>
            <a href="#" class="link-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="addCompetitionCategoryModal">
                <div>
                    <span>カテゴリを追加</span>
                </div>
            </a>
        </div>
    </div>
    <div>
        <strong>マット（複数選択可）</strong>
    </div>
    <div>
        <strong>大会画像</strong>
        <input type="file" name="image_path" id="Image_path">
    </div>

    <div>
        <button type="submit">送信</button>
    </div>
</form>
