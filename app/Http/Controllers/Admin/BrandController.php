<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $brnad = Brand::all();
            return DataTables::of($brnad)
            ->addIndexColumn()
            ->addColumn('brand_image', function($row){
                return '<img src="'. asset('files/brands/'.$row->brand_logo) .'" height="50"/>';
            })
            ->addColumn('action', function($row){
                $actionbtn = '<a href="javascript:void(0)" data-id="'.$row->id.'" data-toggle="modal" data-target="#EditBrandModal"  class="btn btn-sm btn-primary edit"><i class="fas fa-edit"></i></a>';
                $actionbtn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-sm btn-danger ml-2" id="delete"><i class="fas fa-trash"></i></a>';
                return $actionbtn;
            })
            ->rawColumns(['brand_image', 'action'])
            ->make(true);
        }

        return view('admin.category.brand.index');
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
            'brand_name'    => 'required|unique:brands|max:32',
            'image'         => 'required|image|mimes:png,jpg,jpeg|max:1024',
        ]);

        $slug = Str::slug($request->brand_name, '-');
        $photoname = $request->image;
        $brand_logo = $slug. '.' . $photoname->getClientOriginalExtension();   
        Image::make($photoname)->resize(240, 120)->save(public_path('files/brands/').$brand_logo);                                            
        

        $data = [
            'brand_name'    => $request->brand_name,
            'brand_slug'    => $slug,
            'brand_logo'    => $brand_logo
        ];
        Brand::create($data);
        return response()->json(['message' => 'Brand insert successfully.']);

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
        $brnads = Brand::find($id);
        return view('admin.category.brand.edit', compact('brnads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'brand_name'    => 'required|unique:brands|max:32',
            'image'         => 'required|image|mimes:png,jpg,jpeg|max:1024',
        ]);

        $slug = Str::slug($request->brand_name, '-');
        $photoname = $request->image;
        $brand_logo = $slug. '.' . $photoname->getClientOriginalExtension();   
                                                    
        if( $request->image ){
            if( File::exists($request->old_image) ){
                unlink($request->old_image);
            }
            Image::make($photoname)->resize(240, 120)->save(public_path('files/brands/').$brand_logo);
        }

        $data = [
            'brand_name'    => $request->brand_name,
            'brand_slug'    => $slug,
            'brand_logo'    => $brand_logo
        ];
        Brand::where('id', $id)->update($data);
        $notification = array('message'=>'Child Category update successfully.', 'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Brand::find($id);
        $delete->delete();
        return response()->json(['success'=> 'Child Category delete successfully.']);
    }
}
