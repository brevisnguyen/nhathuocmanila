<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $attributes = ['product_unit_id', 'quantity', 'amount'];

    protected function subtotal(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->quantity * $this->amount
        );
    }

    public static function fromAttribute($product_unit_id, $quantity, $amount)
    {
        $cart = new self();
        $cart->product_unit_id = $product_unit_id;
        $cart->quantity = $quantity;
        $cart->amount = $amount;

        return $cart;
    }
}
