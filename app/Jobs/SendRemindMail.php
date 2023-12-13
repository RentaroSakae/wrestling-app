<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Game;
use App\Models\RemindHistory;
use App\Models\UserCompetitionPlayer;
use App\Models\CompetitionSchedule;

class SendRemindMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $gameId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($gameId)
    {
        $this->gameId = $gameId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        // 現在の試合番号を取得
        //ここがおかしい
        $currentGame = Game::with('round.competitionSchedule')->find($this->gameId);

        if ($currentGame) {
            Log::info("Game found: {$currentGame->id}");
            if ($currentGame->round) {
                Log::info("Round found: {$currentGame->round->id}");
                if ($currentGame->round->competitionSchedule) {
                    Log::info("CompetitionSchedule found: {$currentGame->round->competitionSchedule->id}");
                } else {
                    Log::info("CompetitionSchedule not found");
                }
            } else {
                Log::info("Round not found");
            }
        } else {
            Log::info("Game not found");
        }

        $matId = $currentGame->round->competitionSchedule->mat_id;

        $currentMatchNumber = $this->getCurrentMatchNumber($currentGame);

        // 通知を受け取るべきユーザーを特定
        $notificationEntries = UserCompetitionPlayer::with('classfiedCompetitionPlayer')
            ->get();

        foreach ($notificationEntries as $entry) {
            // 次の試合までの残り試合数を計算
            $remainingMatches = $this->calculateRemainingMatches($currentGame, $entry->classfiedCompetitionPlayer);

            // 通知条件をチェック
            if ($remainingMatches <= $entry->notify_before) {
                $user = $entry->user;

                // メール送信
                Mail::raw("{$entry->classfiedCompetitionPlayer->player->name} 選手の試合はあと {$remainingMatches} 試合後です。", function ($message) use ($user) {
                    $message->to($user->email)->subject('試合通知');
                });

                // 送信履歴を記録
                RemindHistory::create([
                    'game_id' => $currentGame->id,
                    'user_id' => $user->id
                ]);
            }
        }
    }

    private function getCurrentMatchNumber($game, $matId)
    {

        // ここに現在のマットでの試合番号を計算するロジックを実装
        // 同じマットで、現在のゲームより前に行われたゲームの数を数える
        $numberOfPreviousGames = Game::whereHas('round.competitionSchedule', function ($query) use ($matId, $game) {
            $query->where('mat_id', $matId);
            $query->where('date', $game->round->competitionSchedule->date);
        })->where('id', '<', $game->id)->count();

        // 現在の試合番号は、これまでの試合の数に1を加えたもの
        return $numberOfPreviousGames + 1;
    }

    private function processGameNotification($game, $currentMatchNumber)
    {
        // 通知すべきユーザーを取得
        $usersToNotify = UserCompetitionPlayer::whereHas('classfiedCompetitionPlayer', function ($query) use ($game) {
            $query->where('red_player_id', $game->red_player_id)
                ->orWhere('blue_player_id', $game->blue_player_id);
        })->get();

        foreach ($usersToNotify as $userNotification) {
            $remainingMatches = $this->calculateRemainingMatches($game, $currentMatchNumber);

            // 通知条件を満たすか確認
            if ($this->shouldNotify($userNotification, $remainingMatches)) {
                $this->sendNotification($userNotification->user, $game, $remainingMatches);
                $this->recordNotification($userNotification->user->id, $game->id);
            }
        }
    }

    private function calculateRemainingMatches($game, $matId)
    {
        // 残り試合数を計算
        // 同じマットで現在のゲームより後に行われるゲームの数を数える
        $numberOfRemainingGames = Game::whereHas('round.competitionSchedule', function ($query) use ($matId, $game) {
            $query->where('mat_id', $matId);
            $query->where('date', $game->round->competitionSchedule->date);
        })->where('id', '>', $game->id)->count();

        return $numberOfRemainingGames;
    }

    private function shouldNotify($userNotification, $remainingMatches)
    {
        // 通知するべきか判断するロジックを実装
        return ($remainingMatches <= $userNotification->notify_before) && !$this->isNotifiedBefore($userNotification->user->id, $game->id);
    }

    private function sendNotification($user, $game, $remainingMatches)
    {
        // メール送信処理を実装
        Mail::raw("{$game->id}番の試合はあと{$remainingMatches}試合後です。", function ($message) use ($user) {
            $message->to($user->email)->subject('試合通知');
        });
    }

    private function recordNotification($userId, $gameId)
    {
        // 通知履歴を記録
        RemindHistory::create([
            'user_id' => $userId,
            'game_id' => $gameId
        ]);
    }

    private function isNotifiedBefore($userId, $gameId)
    {
        // 既に通知されているか確認
        return RemindHistory::where('user_id', $userId)->where('game_id', $gameId)->exists();
    }
}
