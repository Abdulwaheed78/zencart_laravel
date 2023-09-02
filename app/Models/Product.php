<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category(){

        return $this->belongsTo(Category::class,'category_id');
    }

    public function brands(){

        return $this->belongsTo(Brands::class,'brand_id');
    }


    public function subcategory(){

        return $this->belongsTo(SubCategories::class,'sub_category_id');
    }


}
