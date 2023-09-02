<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id', 'product_title', 'product_price', 'quantity', 'user_role'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
