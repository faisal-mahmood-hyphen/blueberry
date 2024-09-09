<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trim extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'brand_id',
        'model_id',
        'trims',
        'status',
        'deleted_at',
    ];
    public function permissions()
    {
        return $this->hasMany(RolePermission::class);
    }
    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function models()
    {
        return $this->belongsTo(Models::class, 'model_id');
    }
}
