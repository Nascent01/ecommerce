<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ProductAttributeChoice extends Model
{
    use HasSlug;

    protected $fillable = [
        'product_attribute_id',
        'name',
        'slug',
    ];

    public function productAttribute(): BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function scopeFilter($query, $name = null): \Illuminate\Database\Eloquent\Builder
    {
        return $query->when($name, function ($q) use ($name) {
            $q->where('name', 'like', '%' . $name . '%');
        });
    }

    public function productsUsingThisChoiceCount(): int
    {
        $choiceId = $this->id;

        return Product::whereHas('productAttributeChoices', function ($query) use ($choiceId) {
            $query->where('product_attribute_choice_id', $choiceId);
        })->count();
    }
}
