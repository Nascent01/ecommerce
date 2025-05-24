<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasSlug;
    use SoftDeletes;

    protected $fillable = [
        'sku',
        'name',
        'slug',
        'image',
        'price',
        'is_active',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    public function productAttributeChoices(): BelongsToMany
    {
         return $this->belongsToMany(ProductAttributeChoice::class, 'product_product_attribute_choice');
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

    public function scopeFilter($query, $name = null, $sku = null)
    {
        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if ($sku) {
            $query->where('sku', 'like', '%' . $sku . '%');
        }

        return $query;
    }
}
