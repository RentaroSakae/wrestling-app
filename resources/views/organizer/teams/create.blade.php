<div>
    <h2>チームを追加</h2>
</div>

<form action="{{ route('organizer.teams.store') }}" method="POST">
    @csrf
    <div>
        <strong>チーム名</strong>
        <input type="text" name="name" id="name">
    </div>

    <div>
        <button type="submit">送信</button>
    </div>
</form>
