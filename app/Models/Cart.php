<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $table = 'product_unit';
    public $incrementing = false;
    public $timestamps = false;
    protected $attributes = ['sku', 'product_id', 'unit_id', 'quantity', 'amount'];

    protected function subtotal(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->quantity * $this->amount,
        );
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public static function fromAttribute($sku, $product_id, $unit_id, $quantity, $amount)
    {
        $cart = new self();
        $cart->sku = $sku;
        $cart->product_id = $product_id;
        $cart->unit_id = $unit_id;
        $cart->quantity = $quantity;
        $cart->amount = $amount;

        return $cart;
    }
}
