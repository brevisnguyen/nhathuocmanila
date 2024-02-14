<?php

namespace App\Livewire;

use App\Enums\Payment;
use App\Services\CartManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class PlacedOrder extends Component
{
    public $name = '';
    public $phone = '';
    public $address = '';
    public $payment = Payment::SHIP_COD->value;
    public $note = '';
    public Collection $items;
    public $subtotal = 0;

    public function placedOrder()
    {
        if (CartManager::count() <= 0) {
            Toaster::warning('Bạn chưa có sản phẩm nào!');

            $this->redirect(route('home'), navigate: true);
        }

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'min:10'],
            'address' => ['required', 'string', 'max:255'],
            'payment' => [Rule::enum(Payment::class)],
            'note' => ['string', 'max:255'],
        ]);

        $order = CartManager::order();
        $order->phone = $validated['phone'];
        $order->address = $validated['address'];
        $order->payment = $validated['payment'];
        $order->description = $validated['note'];
        $order->save();

        CartManager::clear();

        Toaster::success('Đặt đơn hàng thành công!');

        $this->redirect(route('profile'), navigate: true);
    }

    public function mount()
    {
        $this->name = Auth::user()?->name;

        $this->items = CartManager::items();
        $this->subtotal = CartManager::subtotal();
    }

    public function render()
    {
        return view('livewire.placed-order');
    }
}
