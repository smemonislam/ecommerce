<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $childcat = DB::table('child_categories as cc')
        ->select('cc.id', 'cc.category_id', 'cc.subcategory_id', 'cc.name', 'cc.slug', 'c.name as cname', 'sc.subcategory_name')
        ->leftJoin('categories as c', 'cc.category_id', 'c.id')
        ->leftJoin('sub_categories as sc', 'cc.subcategory_id', 'sc.id')
        ->get();

        if( $request->ajax() ){
            return DataTables::of($childcat)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn = '<button data-id="'.$row->id.'" data-toggle="modal" data-target="#EditCategoryModal"  class="btn btn-sm btn-primary edit"><i class="fas fa-edit"></i></button>';
                $actionbtn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-sm btn-danger ml-2" id="delete"><i class="fas fa-trash"></i></a>';
                return $actionbtn;
            })
            ->editColumn('category_id', function($name) {
                return $name->cname;
            })
            ->editColumn('subcategory_id', function($name) {
                return $name->subcategory_name;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.category.childcategory.index');
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
            'name'  => 'required|min:3|max:255'
        ]);

        $subcat = DB::table('sub_categories')->where('id', $request->subcategory_id)->first();
        $data = [
            'category_id'       => $subcat->category_id,
            'subcategory_id'    => $request->subcategory_id,
            'name'             => $request->name,
            'slug'             => Str::slug($request->name, '-')
        ];

        ChildCategory::create($data);
        $notification = array('message'=>'Child Category added successfully.');
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
        $childcat = DB::table('child_categories')->where('id', $id)->first();
        return view('admin.category.childcategory.edit', compact('childcat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'  => 'required|min:3|max:255'
        ]);
        $childcat = DB::table('child_categories')->where('id', $id)->first();
        $data = [
            'category_id'       => $childcat->category_id,
            'subcategory_id'    => $request->subcategory_id,
            'name'              => $request->name,
            'slug'              => Str::slug($request->name, '-')
        ];
       
        ChildCategory::where('id', $id)->update($data);
        $notification = array('message'=>'Child Category update successfully.', 'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = ChildCategory::find($id);
        $delete->delete();
        return response()->json(['success'=> 'Child Category delete successfully.']);
    }
}
