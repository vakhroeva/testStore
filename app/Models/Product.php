<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id'
    ];

    public function category() : belongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class);
    }
}
