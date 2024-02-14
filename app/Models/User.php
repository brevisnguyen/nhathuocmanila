<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'telegram_id', 'email', 'password', 'role'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = [
        'password' => 'hashed',
        'role' => Role::class
    ];
    protected $attributes = ['role' => Role::GUEST];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
