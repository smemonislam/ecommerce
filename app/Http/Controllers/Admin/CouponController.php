<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if( $request->ajax() ){
            return DataTables::of(Coupon::query())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn = '<button data-id="'.$row->id.'" data-toggle="modal" data-target="#EditCouponModal"  class="btn btn-sm btn-primary edit"><i class="fas fa-edit"></i></button>';
                $actionbtn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-sm btn-danger ml-2" id="delete"><i class="fas fa-trash"></i></a>';
                return $actionbtn;
            })
            ->addColumn('category_id', function($user) {
                return $user->name;
            })
            ->make(true);
        }
        return view('admin.offer.coupon.index');
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
        $request->validate([
            'coupon_code'   => 'required',
            'coupon_type'   => 'required|between:1,2',
            'coupon_amount' => 'required',
            'coupon_date'   => 'required|date',
            'coupon_status' => 'required',
        ]);

        $data = [
            'coupon_code'       => $request->coupon_code,
            'coupon_type'       => $request->coupon_type,
            'coupon_amount'     => $request->coupon_amount,
            'coupon_date'       => $request->coupon_date,
            'coupon_status'     => $request->coupon_status,
        ];
        Coupon::create($data);
        $notification = array('message'=>'Coupon insert successfully.');
        return response()->json($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupons = Coupon::findOrFail($id);
        return response()->json($coupons);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'coupon_code'   => 'required',
            'coupon_type'   => 'required|between:1,2',
            'coupon_amount' => 'required',
            'coupon_date'   => 'required|date',
            'coupon_status' => 'required',
        ]);

        $data = [
            'coupon_code'       => $request->coupon_code,
            'coupon_type'       => $request->coupon_type,
            'coupon_amount'     => $request->coupon_amount,
            'coupon_date'       => $request->coupon_date,
            'coupon_status'     => $request->coupon_status,
        ];
        Coupon::where('id', $id)->update($data);
        $notification = array('message'=>'Coupon update successfully.');
        return response()->json($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Coupon::find($id);
        $delete->delete();
        return response()->json(['success'=> 'Coupon delete successfully.']);
    }
}
