<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SubCategories extends Model
{
    use HasFactory;

    protected $fillable=[

        'id',
        'name',
        'slug',
        'status',
        'category_id',
    ];

    public function subcategory(){

        return $this->hasMany(Product::class,'sub_category_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brands()
    {
        return $this->hasMany(Brand::class);
    }
}

