<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasSlug, SoftDeletes;

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
        return $this->belongsToMany(ProductCategory::class, 'product_product_category');
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

    public function scopeFilter($query, $name = null, $sku = null, $isActive = null)
    {
        if (!empty($name)) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if (!empty($sku)) {
            $query->where('sku', 'like', '%' . $sku . '%');
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

    public function getImage(): string
    {
        return $this->image ? asset(\App\Constants\FilePath\FilePathConstant::PRODUCT_IMAGE_PATH . $this->image) : asset('themes/custom/images/placeholder-image.jpg');
    }
}
