<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_number',
        'customer_id',
        'assigned_staff_id',
        'service_id',
        'status',
        'progress_percentage',
        'total_weight',
        'total_price',
        'notes',
        'estimated_completion',
        'completed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'progress_percentage' => 'integer',
        'total_weight' => 'decimal:2',
        'total_price' => 'decimal:2',
        'estimated_completion' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the customer who owns this order.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the service type for this order.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the staff assigned to this order.
     */
    public function assignedStaff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_staff_id');
    }

    /**
     * Get complaints related to this order.
     */
    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }
}