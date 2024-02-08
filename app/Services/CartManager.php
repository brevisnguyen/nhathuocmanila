<?php

namespace App\Services;
use App\Models\Cart;
use Illuminate\Support\Collection;

class CartManager
{
    protected static $session_key = 'carts';

    public static function add(int $product_unit_id, int $quantity, $amount)
    {
        $items = static::items();
        $item = static::item($product_unit_id);

        if ($item) {
            $item->quantity = $quantity;
        } else {
            $item = Cart::fromAttribute($product_unit_id, $quantity, $amount);
            $items->put($product_unit_id, $item);
        }

        session([static::$session_key => $items]);

        return $item;
    }

    public static function remove(int $product_unit_id)
    {
        $items = static::items();
        $items->pull($product_unit_id);

        session([static::$session_key => $items->all()]);

        return true;
    }

    public static function update()
    {

    }

    public static function clear()
    {
        session()->forget(static::$session_key);

        return true;
    }

    public static function item(int $product_unit_id): Cart|null
    {
        $item = static::items()->firstWhere('product_unit_id', $product_unit_id);
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
}
