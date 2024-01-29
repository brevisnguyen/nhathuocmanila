<?php

namespace App\Models;

use App\Enums\Payment;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'payment',
        'status',
        'description',
        'attachments',
        'subtotal',
        'total'
    ];

    protected $casts = [
        'attachments' => 'array',
        'status' => Status::class,
        'payment' => Payment::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
