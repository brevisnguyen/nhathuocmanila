<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer', 'phone', 'payment_method', 'total_amount'];

    public function medications(): BelongsToMany
    {
        return $this->belongsToMany(Medication::class, 'order_medication');
    }
}
