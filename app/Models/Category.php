<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'name',
        'description',
        'image',
        'status',
        'deleted_at',
    ];

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class,'parent_id', 'id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class,'parent_id', 'id');
    }

}
