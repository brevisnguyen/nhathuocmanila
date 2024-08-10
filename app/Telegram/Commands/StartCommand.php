<?php

namespace App\Telegram\Commands;

use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;

class StartCommand extends Command
{
    protected string $command = 'start';

    protected ?string $description = 'Tin nhắn mở đầu';

    public function handle(Nutgram $bot): void
    {
        $msg = message('start', ['chat' => $bot->chat()]);
        $button = InlineKeyboardMarkup::make()
            ->addRow(
                InlineKeyboardButton::make(text: 'Nhóm Nhà Thuốc Manila', url: 'https://t.me/nhathuocmanila')
            );
        $bot->sendMessage($msg, parse_mode: ParseMode::HTML, reply_markup: $button);
    }
}
