<?php

namespace App\Services;
use App\Enums\Status;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CartManager
{
    protected static $session_key = 'carts';

    public static function add(int $sku, int $product_id, int $unit_id, int $quantity, $amount)
    {
        $items = static::items();
        $item = static::item($sku);

        if ($item) {
            $item->quantity += $quantity;
        } else {
            $item = Cart::fromAttribute($sku, $product_id, $unit_id, $quantity, $amount);
            $items->put($sku, $item);
        }

        session([static::$session_key => $items]);

        return $item;
    }

    public static function remove($sku)
    {
        $items = static::items();
        $items->pull($sku);

        session([static::$session_key => $items]);

        return true;
    }

    public static function update($sku, $quantity = null, $amount = null)
    {
        $items = static::items();
        $item = static::item($sku);

        if ($item) {
            if (! is_null($quantity)) {
                $item->quantity = $quantity;
            }
            if (! is_null($amount)) {
                $item->amount = $amount;
            }

            if ($item->quantity <= 0) {
                return static::remove($sku);
            } else {
                $items->put($sku, $item);
                session([static::$session_key => $items]);
            }

            return $item;
        }

        return null;
    }

    public static function clear()
    {
        session()->forget(static::$session_key);

        return true;
    }

    public static function item($sku): Cart|null
    {
        $item = static::items()->firstWhere('sku', $sku);
        return $item;
    }

    public static function items(): Collection
    {
        $items = session(static::$session_key, collect());
        return $items;
    }

    public static function subtotal()
    {
        return static::items()->sum('subtotal');
    }

    public static function count(): int
    {
        return static::items()->count();
    }

    public static function order(): Order
    {
        $order = new Order();

        $order->user_id = Auth::id();
        $order->status = Status::PENDING;
        $order->subtotal = static::subtotal();
        $order->shipping = 0;
        $order->save();

        foreach (static::items() as $item) {
            $orderItem = new OrderItem($item->toArray());

            $order->items()->save($orderItem);
        }

        return $order;
    }
}
