<?php

namespace App\Repositories;

use App\Enums\StatusEnum;
use App\Models\Feature;

class FeatureRepo
{

    public static function getAllFeatures($status = StatusEnum::ACTIVE,$orderByColumn = 'name',$orderBy = 'asc'){
        $features = Feature::query();
        if($status){
            $features->where('status',$status);
        }

        return $features->orderBy($orderByColumn,$orderBy)->get();
    }
}
