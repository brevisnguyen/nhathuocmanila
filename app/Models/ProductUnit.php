<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductUnit extends Model
{
    use HasFactory;

    protected $table = 'product_unit';
    protected $fillable = ['product_id', 'unit_id', 'amount'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(OrderItem::class, 'order_item', 'product_unit_id', 'order_id');
    }
}
