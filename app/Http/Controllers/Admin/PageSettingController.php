<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Page::get();
        return view('admin.setting.page.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.setting.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            "page_position" => $request->page_position,
            "page_name" => $request->page_name,
            "page_slug" => Str::slug($request->page_name, '-'),
            "page_title" => $request->page_title,
            "page_description" => $request->page_description,
        ];
        Page::create($data);
        $notification = array('message'=>'Page Created!.', 'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Page::find($id);
        return view('admin.setting.page.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = [
            "page_position" => $request->page_position,
            "page_name"     => $request->page_name,
            "page_slug"     => Str::slug($request->page_name, '-'),
            "page_title"    => $request->page_title,
            "page_description" => $request->page_description,
        ];
        Page::where('id', $id)->update($data);
        $notification = array('message'=>'Page Updated!.', 'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Page::find($id);
        $delete->delete();
        $notification = array('message'=>'Page delete successfully.', 'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
