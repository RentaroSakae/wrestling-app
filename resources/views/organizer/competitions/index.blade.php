@push('styles')
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('/js/script.js') }}"></script>
@endpush

<a href="{{ route('organizer.competitions.create') }}">新しい大会を作成する</a>

<div>
    <a href="{{ route('organizer.competitions.index', ['target' => 'current']) }}">現在開催中の大会</a>
    <a href="{{ route('organizer.competitions.index', ['target' => 'future']) }}">近日開催予定の大会</a>
    <a href="{{ route('organizer.competitions.index', ['target' => 'past']) }}">過去に開催された大会</a>
</div>

<table>
    <tr>
        <th>大会名</th>
        <th>大会会場</th>
    </tr>
    @if (count($currentCompetitions) > 0)
        @foreach ($currentCompetitions as $competition)
            <tr>
                <td>{{ $competition->name }}</td>
                <td>{{ $competition->place->name }}</td>
                <td>
                    <a href="{{ route('organizer.competitions.show', ['competition' => $competition->id]) }}">詳細</a>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="6">該当する大会がありません。</td>
        </tr>
    @endif
</table>
