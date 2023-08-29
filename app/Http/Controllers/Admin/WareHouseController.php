<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Warehouse;

class WareHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if( $request->ajax() ){
             return DataTables::of(Warehouse::query())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn = '<button data-id="'.$row->id.'" data-toggle="modal" data-target="#EditWarehouseModal"  class="btn btn-sm btn-primary edit"><i class="fas fa-edit"></i></button>';
                $actionbtn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-sm btn-danger ml-2" id="delete"><i class="fas fa-trash"></i></a>';
                return $actionbtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.category.warehouse.index');
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
            'warehouse_name'        => 'required|min:3|max:255',
            'warehouse_address'     => 'required|min:3|max:255',
            'warehouse_phone'       => 'required',
        ]);

        
        $data = [
            'warehouse_name'       => $request->warehouse_name,
            'warehouse_address'    => $request->warehouse_address,
            'warehouse_phone'      => $request->warehouse_phone,
        ];

        Warehouse::create($data);
        $notification = array('message'=>'Warehouse added successfully.');
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
        $data = Warehouse::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'warehouse_name'        => 'required|min:3|max:255',
            'warehouse_address'     => 'required|min:3|max:255',
            'warehouse_phone'       => 'required',
        ]);

        
        $data = [
            'warehouse_name'       => $request->warehouse_name,
            'warehouse_address'    => $request->warehouse_address,
            'warehouse_phone'      => $request->warehouse_phone,
        ];

        Warehouse::where('id', $id)->update($data);
        $notification = array('message'=>'Warehouse update successfully.');
        return response()->json($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Warehouse::find($id);
        $delete->delete();
        return response()->json(['success'=> 'Child Category delete successfully.']);
    }
}
