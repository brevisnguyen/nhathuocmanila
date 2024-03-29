<?php
/** @var SergiX44\Nutgram\Nutgram $bot */

use App\Http\Controllers\TelegramController;
use App\Telegram\Commands\StartCommand;
use SergiX44\Nutgram\Nutgram;

/*
|--------------------------------------------------------------------------
| Nutgram Handlers
|--------------------------------------------------------------------------
|
| Here is where you can register telegram handlers for Nutgram. These
| handlers are loaded by the NutgramServiceProvider. Enjoy!
|
*/
Route::post('/webhook', TelegramController::class);

$bot->registerCommand(StartCommand::class);
