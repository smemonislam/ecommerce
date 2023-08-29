<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Admin\PickupPoint;

class PickupPointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){            
            return DataTables::of(PickupPoint::query())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn = '<a href="javascript:void(0)" data-id="'.$row->id.'" data-toggle="modal" data-target="#EditPickupPointModal"  class="btn btn-sm btn-primary edit"><i class="fas fa-edit"></i></a>';
                $actionbtn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-sm btn-danger ml-2" id="delete"><i class="fas fa-trash"></i></a>';
                return $actionbtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.pickup_point.index');
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
            'pickup_point_name'         => 'required',
            'pickup_point_address'      => 'required',
            'pickup_point_phone'        => 'required',
            'pickup_point_phone_two'    => 'required',
        ]);

        $data = [
            'pickup_point_name'         => $request->pickup_point_name,
            'pickup_point_address'      => $request->pickup_point_address,
            'pickup_point_phone'        => $request->pickup_point_phone,
            'pickup_point_phone_two'    => $request->pickup_point_phone_two,
        ];
        PickupPoint::create($data);
        $notification = array('message'=>'Pickup Point insert successfully.');
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
        $pickup = PickupPoint::findOrFail($id);
        return response()->json($pickup);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'pickup_point_name'         => 'required',
            'pickup_point_address'      => 'required',
            'pickup_point_phone'        => 'required',
            'pickup_point_phone_two'    => 'required',
        ]);

        $data = [
            'pickup_point_name'         => $request->pickup_point_name,
            'pickup_point_address'      => $request->pickup_point_address,
            'pickup_point_phone'        => $request->pickup_point_phone,
            'pickup_point_phone_two'    => $request->pickup_point_phone_two,
        ];

        PickupPoint::where('id', $id)->update($data);
        $notification = array('message'=>'Pickup Point update successfully.');
        return response()->json($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = PickupPoint::findOrFail($id);
        $delete->delete();
        return response()->json(['success'=> 'Pickup Point delete successfully.']);
    }
}
