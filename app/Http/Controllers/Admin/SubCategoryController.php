<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {  
        $subCategory = DB::table('sub_categories as sc')
        ->select('sc.id as scid', 'c.id', 'sc.subcategory_name', 'sc.subcategory_slug', 'c.name')
        ->leftJoin('categories as c', 'sc.category_id', 'c.id')
        ->get();

        if( $request->ajax() ){
            return DataTables::of($subCategory)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn = '<button data-id="'.$row->scid.'" data-toggle="modal" data-target="#EditCategoryModal"  class="btn btn-sm btn-primary edit"><i class="fas fa-edit"></i></button>';
                $actionbtn .= '<a href="javascript:void(0)" data-id="'.$row->scid.'" class="btn btn-sm btn-danger ml-2" id="delete"><i class="fas fa-trash"></i></a>';
                return $actionbtn;
            })
            ->addColumn('category_id', function($user) {
                return $user->name;
            })
            ->make(true);
        }
       
        
        return view('admin.category.subcategory.index');

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
            'name'  => 'required',
            'category_id' => 'required|numeric'
        ]);

        $data = [
            'category_id'       => $request->category_id,
            'subcategory_name'  => $request->name,
            'subcategory_slug'  => Str::slug(strtolower($request->input('name')), '-')
        ];
        SubCategory::create($data);
        $notification = array('message'=>'Sub Category insert successfully.');
        return response()->json($notification);

    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
       
        $subcat = SubCategory::findOrFail($id);
        $categories = DB::table('categories')->pluck('name', 'id');
        return response()->json( [
            'categories'    => $categories,
            'subcategories' => $subcat,
        ] );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required',
            'category_id' => 'required|numeric'
        ]);

        $data = [
            'category_id'       => $request->category_id,
            'subcategory_name'  => $request->name,
            'subcategory_slug'  => Str::slug(strtolower($request->input('name')), '-')
        ];
        
        SubCategory::where('id', $request->id)->update($data);
        $notification = array('message'=>'Sub Category update successfully.', 'alert-type'=>'success');
        return response()->json($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = SubCategory::find($id);
        $delete->delete();
        return response()->json(['success'=> 'Sub Category delete successfully.']);
    }
}
