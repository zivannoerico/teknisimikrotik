<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    protected $fillable = [
        'name',
        'badge',
        'price',
        'billing_period',
        'description',
        'features',
        'is_popular',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'is_popular' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:0',
    ];

    /**
     * Price formatted in Rupiah, or null when no price has been set.
     */
    protected function formattedPrice(): Attribute
    {
        return Attribute::get(fn (): ?string => (float) $this->price > 0
            ? 'Rp '.number_format((float) $this->price, 0, ',', '.')
            : null);
    }
}
