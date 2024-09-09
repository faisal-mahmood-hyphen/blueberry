<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Models extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'brand_id',
        'name',
        'status',
        'deleted_at',
    ];
    public function permissions()
    {
        return $this->hasMany(RolePermission::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function models()
    {
        return $this->hasMany(Brand::class);
    }
}
