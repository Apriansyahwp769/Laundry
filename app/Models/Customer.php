<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'whatsapp',
        'address',
        'loyalty_points',
        'is_vip',
        'preferences',
        'cached_total_orders',
        'cached_total_weight',
        'cached_lifetime_value',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_vip' => 'boolean',
        'preferences' => 'array',
        'loyalty_points' => 'integer',
        'cached_total_orders' => 'integer',
        'cached_total_weight' => 'decimal:2',
        'cached_lifetime_value' => 'decimal:2',
    ];

    /**
     * Get all orders from this customer.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get all complaints from this customer.
     */
    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }
}