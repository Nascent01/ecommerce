<?php 

namespace App\Repositories\Product;

use App\Models\Product\ProductAttributeChoice;

class ProductAttributeChoiceRepository
{
    public function baseProductAttributeChoiceQuery()
    {
        return ProductAttributeChoice::query()->with('productAttribute');
    }

    public function getSearchResults($search, $excludeIds = [])
    {
        return $this->baseProductAttributeChoiceQuery()
            ->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhereHas('productAttribute', function($q) use ($search) {
                          $q->where('name', 'like', '%' . $search . '%');
                      });
            })
            ->whereNotIn('id', $excludeIds)
            ->limit(10)
            ->get();
    }
}