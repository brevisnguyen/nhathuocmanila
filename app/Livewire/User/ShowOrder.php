<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ShowOrder extends Component
{
    public $order;
    public $user;
    public $attachments = [];

    public function mount($order)
    {
        $this->order = $order;
        $this->user = $order->user;

        if ($order->attachments) {
            foreach ($order->attachments as $file) {
                if (Storage::disk('orders')->exists($file)) {
                    array_push($this->attachments, Storage::disk('orders')->url($file));
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.user.show-order');
    }
}
