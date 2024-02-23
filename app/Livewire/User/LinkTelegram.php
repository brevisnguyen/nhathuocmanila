<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class LinkTelegram extends Component
{
    public $telegram_id;

    public function mount()
    {
        $this->telegram_id = Auth::user()?->telegram_id;
    }

    public function linkToTelegram()
    {
        try {

            $validated = $this->validate(['telegram_id' => 'sometimes|numeric']);

        } catch (ValidationException $e) {
            $this->reset('telegram_id');

            throw $e;
        }

        Auth::user()->update(['telegram_id' => $validated['telegram_id']]);

        $this->reset('telegram_id');
        $this->dispatch('close-modal', 'link-telegram-modal');

        Toaster::success('Cập nhật dữ liệu thành công');
    }

    public function render()
    {
        return view('livewire.user.link-telegram');
    }
}
