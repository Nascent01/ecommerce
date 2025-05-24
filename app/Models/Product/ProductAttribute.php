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

    public function scopeFilter($query, $name = null)
    {
        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        return $query;
    }
}
