<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'client_name',
        'category',
        'location',
        'summary',
        'challenge',
        'solution',
        'result',
        'device_used',
        'image',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Public URL of the portfolio illustration, or null when no image file is available.
     */
    protected function imageUrl(): Attribute
    {
        return Attribute::get(function (): ?string {
            if (! $this->image) {
                return null;
            }

            if (Str::startsWith($this->image, ['http://', 'https://', '/'])) {
                return $this->image;
            }

            $stem = pathinfo($this->image, PATHINFO_FILENAME);

            foreach (['images/portfolio/'.$this->image, 'images/portfolio/'.$stem.'.webp'] as $path) {
                if (is_file(public_path($path))) {
                    return asset($path);
                }
            }

            return null;
        });
    }
}
