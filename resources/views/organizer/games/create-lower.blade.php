<div>
    <h2>新しい試合を追加</h2>
</div>

<div>
    <a href="{{ route('organizer.competitions.index') }}">トップページに戻る</a>
</div>

<form
    action="{{ route('organizer.games.store-lower', ['competition_id' => $competition->id, 'game_id' => $topGame->id]) }}"
    method="POST">
    @csrf
    <div>
        <strong>スタイル</strong>
        <input type="text" id="style" name="style" value="{{ $topGame->style->name }}" readonly>
    </div>

    <div>
        <strong>階級</strong>
        <input type="text" id="competition_class" name="competition_class"
            value="{{ $topGame->competition_class->class }}" readonly>
    </div>

    <div>
        <strong>回戦</strong>
        <select id="round_id" name="round_id">
            @foreach ($rounds as $round)
                <option value="{{ $round->id }}">{{ $round->round }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <strong>赤コーナー選手</strong>
        <select name="red_player" id="red_player">
            @foreach ($lowGames as $lowGame)
                @if ($lowGame->scoresheet && $lowGame->scoresheet->victory_player)
                    <option value="{{ $lowGame->scoresheet->victory_player_id }}">
                        {{ $lowGame->scoresheet->victory_player->name }}</option>
                @endif
            @endforeach
            <option value="">選手未設定</option>
        </select>
    </div>

    <div>
        <strong>青コーナー選手</strong>
        <select name="blue_player" id="blue_player">
            @foreach ($lowGames as $lowGame)
                @if ($lowGame->scoresheet && $lowGame->scoresheet->victory_player)
                    <option value="{{ $lowGame->scoresheet->victory_player_id }}">
                        {{ $lowGame->scoresheet->victory_player->name }}</option>
                @endif
            @endforeach
            <option value="">選手未設定</option>
        </select>
    </div>



    <div>
        <strong>マット</strong>
        <select name="mat" id="mat">
            @foreach ($mats as $mat)
                <option value="{{ $mat->id }}">{{ $mat->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <strong>試合番号</strong>
        <input type="number" name="game_number" id="Game_number">
    </div>

    <div>
        <button type="submit">送信</button>
    </div>
</form>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
      const styleClassList = {
        "FS":["57kg", "61kg", "65kg", "70kg", "74kg", "79kg", "86kg", "92kg", "97kg", "125kg"],
        "GR":["55kg", "60kg", "63kg", "67kg", "72kg", "77kg", "82kg", "87kg", "97kg", "130kg"],
        "WW":["50kg", "53kg", "55kg", "57kg", "59kg", "62kg", "65kg", "68kg", "72kg", "76kg"],
      }

      const styleSelector = document.getElementById('style-selector');

    // 階級選択要素を取得
        const classSelector = document.getElementById('class-selector');

      $(function () {

        function initStyleSelector() {
          const select = $('#style-selector');
          const styles = Object.keys(styleClassList);

          styles.forEach(function (style, i) {
            const option = $('<option>')
              .text(style)
              .val(style);

            select.append(option);
          });

        }

        function initClassSelector() {
          $('#class-selector option').remove();

          const select = $('#class-selector');

          const style = $("#style-selector").val();

          const classes = styleClassList[style];

          classes.forEach(function (cls, i) {
            var option = $('<option>')
              .text(cls)
              .val(cls);
            select.append(option);
          });

        }

        $("#style-selector").change(function () {
          initClassSelector();
        });

        initStyleSelector();
        initClassSelector();
      });
    </script> --}}
