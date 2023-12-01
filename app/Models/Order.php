<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer', 'phone', 'payment_method', 'total_amount'];

    public function medications(): BelongsToMany
    {
        return $this->belongsToMany(Medication::class, 'order_medication')->withPivot(['quantity', 'amount']);
    }

    public function orderMedications(): HasMany
    {
        return $this->hasMany(OrderMedication::class);
    }

    public function setTotalAmount()
    {
        $this->total_amount = $this->medications()->sum('amount');
        $this->save();
    }
}
