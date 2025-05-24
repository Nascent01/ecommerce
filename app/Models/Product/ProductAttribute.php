<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ProductAttribute extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'weight',
        'is_active',
    ];

    public function productAttributeChoices(): HasMany
    {
        return $this->hasMany(ProductAttributeChoice::class);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function scopeFilter($query, $name = null, $isActive = null)
    {
        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if (!empty($isActive)) {
            if ($isActive === 'active') {
                $query->where('is_active', 1);
            } else {
                $query->where('is_active', 0);
            }
        }

        return $query;
    }
}
