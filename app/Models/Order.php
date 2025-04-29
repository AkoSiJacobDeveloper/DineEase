<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';
    
    public static $statuses = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_PROCESSING => 'Processing',
        self::STATUS_COMPLETED => 'Completed',
        self::STATUS_CANCELLED => 'Cancelled',
    ];

    protected $fillable = [
        'user_id',
        'food_id',
        'quantity',
        'subtotal',
        'service_charge',
        'total',
        'payment_method',
        'status',
        'order_number',
        'notes'
    ];
    
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
}