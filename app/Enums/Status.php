<?php

namespace App\Enums;

enum Status: string
{
    case PENDING = 'pending';
    case SHIPPING = 'shipping';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';
    case IN_STOCK = 'in_stock';
    case SOLD_OUT = 'sold_out';
}
