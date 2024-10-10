<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='categories';

    protected $fillable=['category_name','category_url','category_discription'];

    public function parentCategory(){
        return $this->hasOne('App\Models\Category','id','parent_id')->select('id','category_name','category_url')->where('category_status',1);
         
    }

    public function subCategory()
    {
        return $this->hasMany('App\Models\Category', 'parent_id')->where('category_status', 1); 
    }

    public function nestedSubCategories()
    {
        return $this->subCategory()->with('nestedSubCategories');
    }
    
    public function getCategory()
    {
        return self::with('nestedSubCategories')->where('parent_id', 0)->where('category_status', 1)->get();        
    }



    
}
