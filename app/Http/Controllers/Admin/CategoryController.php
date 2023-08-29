<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::select('id','name', 'slug')->get();
        return view('admin.category.category.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $data = [
            'name'  => $request->input('name'),
            'slug'  => Str::slug(strtolower($request->input('name')), '-')
        ];

        if( $data ){
            Category::create($data);
            $notification = array('message'=>'Category insert successfully.', 'alert-type'=>'success');
            return redirect()->back()->with($notification);
        }
        
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {        
        $data = Category::where('id', $id)->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {     
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $data = [
            'name'  => $request->input('name'),
            'slug'  => Str::slug(strtolower($request->input('name')), '-')
        ];
     
        Category::where('id',$id)->update($data);
        $notification = array('message'=>'Category update successfully.', 'alert-type'=>'success');
        return response()->json($notification);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {        
        $delete = Category::find($id);
        $delete->delete();
        $notification = array('message'=>'Category delete successfully.', 'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
