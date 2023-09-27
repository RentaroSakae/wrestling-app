<div class="modal fade" id="addCompetitionCategoryModal" tabindex="-1" aria-labelledby="addCompetitionCategoryLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCompetitonCategoryModalLabel">カテゴリを追加</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <form action="{{ route('competitions.competitionCategories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="text" name="form-control" id="title">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
