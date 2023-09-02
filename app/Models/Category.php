<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategories;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'slug',
        'status',
    ];
    public function product()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function sub_category() {
        return $this->hasMany (SubCategories::class);
    }


    public function brands()
    {
        return $this->hasMany(Brand::class);
    }
}
