<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;

class Product extends Model
{
    use HasFactory;
    protected $table='products';

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id')->with('parentCategory')->where('category_status', 1);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id')->where('status', 1);
    }

    public function images()
    {
         return $this->hasMany(ProductImage::class,'product_id');
    }

    public function attributes()
    {
        return $this->hasMany(ProductsAttribute::class,'product_id');
    }

}
