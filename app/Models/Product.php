<?php

namespace App\Models;

use App\Models\Admin\PickupPoint;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'child_category_id',
        'brand_id',
        'pickup_point_id',
        'product_name',
        'product_slug',
        'product_code',
        'product_unit',
        'product_tags',
        'product_color',
        'product_size',
        'video',
        'purchase_price',
        'selling_price',
        'discount_price',
        'stock_quantity',
        'discription',
        'thumbnail',
        'images',
        'featured',
        'warehouse',
        'today_deal',
        'product_slider',
        'status',
        'flash_deal_id',
        'cash_on_delivery',
        'admin_id',
        'date',
        'month'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function childcategory(){
        return $this->belongsTo(ChildCategory::class, 'child_category_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function pickuppoint(){
        return $this->belongsTo(PickupPoint::class, 'pickup_point_id');
    }
}
