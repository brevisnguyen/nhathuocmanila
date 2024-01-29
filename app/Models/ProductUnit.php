<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductUnit extends Pivot
{
    use HasFactory;

    protected $table = 'product_unit';
    public $incrementing = true;
    protected $fillable = ['product_id', 'unit_id', 'amount', 'default'];
    public $timestamps = false;
    protected $casts = ['default' => 'boolean'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(OrderItem::class, 'order_item', 'product_unit_id', 'order_id');
    }
}
