<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeChoice extends Model
{
    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }
}
