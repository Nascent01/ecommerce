<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    public function attributeChoices(): HasMany
    {
        return $this->hasMany(AttributeChoice::class);
    }
}
