<?php

namespace App\Repositories;

use App\Enums\StatusEnum;
use App\Models\Category;

class CategoryRepo
{

    public static function getAllFeatureCategories($featureId, $parentId = null, $orderByColumn = 'name', $orderBy = 'asc')
    {
        $categories = Category::query()->where('status', StatusEnum::ACTIVE)
            ->where('feature_id', $featureId);
        if ($parentId) {
            $categories->where('parent_id', $parentId);
        }

        return $categories->orderBy($orderByColumn, $orderBy)->get();
    }
}
