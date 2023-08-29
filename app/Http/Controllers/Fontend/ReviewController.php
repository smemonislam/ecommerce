<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
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

        $check = Review::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
        if( !empty($check)  ){
            $notification = array('message'=>'Already you have a review !', 'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        $data = [
            'user_id'       => Auth::id(),
            'product_id'    => $request->product_id,
            'review'        => $request->review,
            'rating'        => $request->rating,
            'review_date'   => date('d-m-Y'),
            'review_month'  => date('F'),
            'review_year'   => date('Y')
        ];

        Review::create($data);
        $notification = array('message'=>'Thank you for a review !', 'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
