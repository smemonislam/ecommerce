<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'subcategory_id', 'name', 'slug'];

    public function product(){
        return $this->hasOne(Product::class);
    }

    
}
