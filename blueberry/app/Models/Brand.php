<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'name',
        'image',
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
}
