<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(array(
            'product_id' =>'required',
        ));
        
        $check = wishlist::where('product_id', $request->product_id)
       ->where('user_id', Auth::id())
       ->first();

        if(Auth::check()){
            if( $check ){
                $notification = array('message'=>'This item is already in your wishlist!', 'alert_type'=>'warning');
                return response()->json($notification);
            }else{
                $data = [
                    'product_id' => $request->product_id,
                    'user_id'    => Auth::id(),
                ];

                wishlist::create($data);
                $notification = array('message'=>'Added to your wishlist.', 'alert_type'=>'success');
                return response()->json($notification);
            }
        }else{
            $notification = array('message'=>'Login to continue.', 'alert_type'=>'warning');
            return response()->json($notification);
        }
    }

    public function wishlistCount(){
        $wishlist = wishlist::where('user_id', Auth::id())->count();
        return response()->json(['count' => $wishlist]);
    }

    
}
