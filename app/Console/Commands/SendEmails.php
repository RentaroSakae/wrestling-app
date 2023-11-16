<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command send mails for user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        //メールアドレスで繰り返し
        foreach ($users as $user) {
            echo $user['email'] . "\n";

            Mail::raw("これバッチでメールしているよ", function ($message) use ($user) {
                //toで送信先、subjectで件名
                $message->to($user->email)->subject('test');
            });
        }
    }
}
