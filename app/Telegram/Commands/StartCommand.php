<?php

namespace App\Telegram\Commands;

use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Handlers\Type\Command;

class StartCommand extends Command
{
    protected string $command = 'start';

    protected ?string $description = 'Start command';

    public function handle(Nutgram $bot): void
    {
        $bot->sendMessage('This is a command!');
    }
}
