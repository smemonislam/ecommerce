<?php

namespace App\Http\Controllers\Fontend;

use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Cache\RateLimiting\Limit;

class IndexController extends Controller
{
    public function index(){
        $categories = Category::get();
        $banner     = Product::where('status', 1)->where('product_slider', 1)->orderBy('product_slider', 'ASC')->first();
        $featured   = Product::where('status', 1)->where('featured', 1)->orderBy('featured', 'DESC')->Limit(16)->get();
        $popular    = Product::where('status', 1)->orderBy('product_views', 'DESC')->limit(8)->get();
        $trendy     = Product::where('status', 1)->where('trendy', 1)->orderBy('trendy', 'DESC')->limit(8)->get();
        $categories = Category::where('home_page', 1)->orderBy('trendy', 'DESC')->limit(8)->get();

        return view('fontend.index', compact('categories', 'banner', 'featured', 'popular', 'trendy', 'categories'));
    }

    public function productDetails($slug){
       $product = Product::where('product_slug', $slug)->first();
                  Product::where('product_slug', $slug)->increment('product_views');
       $related_product = Product::where('subcategory_id', $product->subcategory_id)
       ->where('product_slug', '!=', $product->product_slug)
       ->orderBy('id', 'DESC')
       ->limit(10)
       ->get();

       $reviews = Review::where('product_id', $product->id)->get();
       return view('fontend.product-details', compact('product', 'related_product', 'reviews'));
    }

    public function productQuickView($id){
        $product = Product::where('id', $id)->first();
        return view('fontend.product-quick-view', compact('product'));
    }
}
