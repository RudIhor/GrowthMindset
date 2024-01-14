<?php

namespace App\Console\Commands;

use App\Models\TelegramUser;
use DefStudio\Telegraph\Facades\Telegraph;
use Illuminate\Console\Command;

class SendUpdatingMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-updating-message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an updating message when new features have released';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $text = "
        Hello! Hope you are well and I want say thank you that you use my bot as an excellent inspiring machine:)
        Here are some changes:\n
        - extended list of available quotes options (1, 2, 3 and 4)\n
        - removed 12 and 14 quotes options a day (because of useless)\n
        - re-structured some menu and formatted commands\' output\n
        - added new languages: German, Ukrainian and Spanish\n
        - added new command /mySettings which allows you to see all your settings\n
        If you want to change language and count of quotes a day use: /settings\n
        Also, now the language of the bot interface will be the one that is currently in your telegram (except ruzzian)\n
        That's all for this time. See you in next time:)\n
        Привіт! Сподіваюся, у вас все добре, і я хочу подякувати вам за те, що ви використовуєте мого бота як чудову надихаючу машину :)
         Ось деякі зміни:\n
         - розширений список доступних варіантів цитат (1, 2, 3 і 4)\n
         - прибрано 12 і 14 опцій цитат в день (через марність)\n
         - змінено структуру меню\n
         - додано нові мови: німецьку, українську та іспанську\n
         - додано нову команду /mySettings яка дозволяє вам передивитсь всі ваші налаштування\n
         Якщо ви хочете змінити мову цитат або кількість їх на день використовуйте /settings\n
         Також тепер мова інтерфейсу боту буде такою, яка є зараз у вашому телеграмі (окрім розійзької)\n
         Наразі це все. Побачимось наступного разу :)";
        $users = TelegramUser::all();
        foreach ($users as $user) {
            Telegraph::chat($user->chat_id)->message(trim($text))->send();
        }
    }
}
