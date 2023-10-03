<div>
    <h2>新しい試合を追加</h2>
</div>

<div>
    <a href="{{ route('competitions.index') }}">トップページに戻る</a>
</div>

<form action="{{ route('organizer.competitions.games.store', ['id' => $competitions->id]) }}" method="POST">
    @csrf
    <div>
        <strong>スタイル</strong>
        <select id="style-selector" name="style"></select>
    </div>

    <div>
        <strong>階級</strong>
        <select id="class-selector" name="class"></select>
    </div>

    <div>
        <strong>赤コーナー選手</strong>
        {{-- TODO 選手一覧から選べるようにする --}}
        <select name="red_player" id="red_player">
            @foreach ($players as $player)
            <option value="{{ $player->id }}">{{ $player->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <strong>青コーナー選手</strong>
        {{-- TODO 選手一覧から選べるようにする --}}
        <select name="blue_player" id="blue_player">
            @foreach ($players as $player)
            <option value="{{ $player->id }}">{{ $player->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <strong>マット</strong>
        {{-- 大会登録画面でマットを登録して選択できるようにする --}}
        <input type="text" name="mat" id="mat">
    </div>

    <div>
        <strong>試合番号</strong>
        <input type="number" name="game_number" id="Game_number">
    </div>

    <div>
        <button type="submit">送信</button>
    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
      const styleClassList = {
        "FS":["57kg", "61kg", "65kg", "70kg", "74kg", "79kg", "86kg", "92kg", "97kg", "125kg"],
        "GR":["55kg", "60kg", "63kg", "67kg", "72kg", "77kg", "82kg", "87kg", "97kg", "130kg"],
        "WW":["50kg", "53kg", "55kg", "57kg", "59kg", "62kg", "65kg", "68kg", "72kg", "76kg"],
      }

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
    </script>

