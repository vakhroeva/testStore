<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'client_name',
        'status',
        'comment',
        'product_id',
        'amount',
        'price'
    ];

    public function product() : belongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
