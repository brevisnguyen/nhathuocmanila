<?php

namespace App\Telegram\Commands;

use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;

class StartCommand extends Command
{
    protected string $command = 'start';

    protected ?string $description = 'Tin nhắn mở đầu';

    public function handle(Nutgram $bot): void
    {
        $msg = message('start', ['chat' => $bot->chat()]);
        $bot->sendMessage($msg, parse_mode: ParseMode::HTML);
    }
}
