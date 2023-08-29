<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouse;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use Dflydev\DotAccessData\Data;
use App\Models\Admin\PickupPoint;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){       
            $query = DB::table('products')
            ->leftJoin('categories', 'categories.id', 'products.category_id')  
            ->leftJoin('sub_categories', 'products.subcategory_id', 'sub_categories.id')  
            ->leftJoin('brands', 'products.brand_id', 'brands.id');
            if( $request->category_id ){    
                $query->where('products.category_id', $request->category_id);
            }
            if( $request->brand_id ){    
                $query->where('products.brand_id', $request->brand_id);
            }
            if( $request->warehouse_id ){    
                $query->where('products.warehouse', $request->warehouse_id);
            }
            if( $request->status ){    
                $query->where('products.status', $request->status);
            }
            
            $query->select('products.*', 'categories.name', 'sub_categories.subcategory_name', 'brands.brand_name')
            ->get();  
            return DataTables::of($query)
            ->editColumn('thumbnail', function( $row ){
                return '<img src="'.asset('files/products/'.$row->thumbnail).'" alt="Not Image Found!" width="50" height="50">';
            })
            ->editColumn('featured', function($row){
                if( $row->featured == 1 ){
                    return '<a href="javascript:void(0)" data-id="'.$row->id.'" class="deactive_featured">
                    <i class="fas fa-thumbs-down text-danger">
                    </i> <span class="badge badge-success">Active</span>
                    </a>';
                }else{
                    return '<a href="javascript:void(0)" data-id="'.$row->id.'" class="active_featured">
                    <i class="fas fa-thumbs-up text-success"></i> 
                    <span class="badge badge-danger">Deactive</span>
                    </a>';
                }
            })
            ->editColumn('today_deal', function($row){
                if( $row->today_deal == 1 ){
                    return '<a href="javascript:void(0)" data-id="'.$row->id.'" class="deactive_deal">
                    <i class="fas fa-thumbs-down text-danger">
                    </i> <span class="badge badge-success">Active</span>
                    </a>';
                }else{
                    return '<a href="javascript:void(0)" data-id="'.$row->id.'" class="active_deal">
                    <i class="fas fa-thumbs-up text-success"></i> 
                    <span class="badge badge-danger">Deactive</span>
                    </a>';
                }
            })
            ->editColumn('product_slider', function($row){
                if( $row->product_slider == 1 ){
                    return '<a href="javascript:void(0)" data-id="'.$row->id.'" class="deactive_slider">
                    <i class="fas fa-thumbs-down text-danger">
                    </i> <span class="badge badge-success">Active</span>
                    </a>';
                }else{
                    return '<a href="javascript:void(0)" data-id="'.$row->id.'" class="active_slider">
                    <i class="fas fa-thumbs-up text-success"></i> 
                    <span class="badge badge-danger">Deactive</span>
                    </a>';
                }
            })
            ->editColumn('trendy', function($row){
                if( $row->trendy == 1 ){
                    return '<a href="javascript:void(0)" data-id="'.$row->id.'" class="deactive_trendy">
                    <i class="fas fa-thumbs-down text-danger">
                    </i> <span class="badge badge-success">Active</span>
                    </a>';
                }else{
                    return '<a href="javascript:void(0)" data-id="'.$row->id.'" class="active_trendy">
                    <i class="fas fa-thumbs-up text-success"></i> 
                    <span class="badge badge-danger">Deactive</span>
                    </a>';
                }
            })
            ->editColumn('status', function($row){
                if( $row->status == 1 ){
                    return '<a href="javascript:void(0)" data-id="'.$row->id.'" class="deactive_status">
                    <i class="fas fa-thumbs-down text-danger">
                    </i> <span class="badge badge-success">Active</span>
                    </a>';
                }else{
                    return '<a href="javascript:void(0)" data-id="'.$row->id.'" class="active_status">
                    <i class="fas fa-thumbs-up text-success"></i> 
                    <span class="badge badge-danger">Deactive</span>
                    </a>';
                }
            })
            
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionbtn = '<a href="'.route('products.edit', $row->id).'" class="btn btn-sm btn-primary edit"><i class="fas fa-edit"></i></a>';
                $actionbtn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-sm btn-danger ml-2" id="delete"><i class="fas fa-trash"></i></a>';
                return $actionbtn;
            })
            ->rawColumns(['action', 'thumbnail', 'category_name', 'subcategory_name', 'brand', 'featured','product_slider', 'today_deal', 'trendy', 'status'])
            ->make(true);
        }
        $this->data['categoires']       = Category::all();
        $this->data['brands']           = Brand::all();
        $this->data['warehouses']       = Warehouse::all();
        $this->data['pickup_point']     = PickupPoint::all();

        return view('admin.product.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    
    {
        $this->data['categoires']       = Category::all();
        $this->data['child_categoires'] = ChildCategory::all();
        $this->data['warehouse']        = Warehouse::all();
        $this->data['brand']            = Brand::all();
        $this->data['pickup_point']     = PickupPoint::all();
        return view('admin.product.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation

        $validation = $request->validate([
            "product_name"      => 'required',
            "product_code"      => 'required|unique:products,product_code|max:255',
            "subcategory_id"    => 'required',
            "child_category_id" => 'required',
            "brand_id"          => 'required',
            "product_unit"      => 'required',
            "selling_price"     => 'required',
            "warehouse"         => 'required',
        ]);

        $slug = Str::slug($request->product_name, '-');
        // Single Image
        $thumbnailImage = '';
        if( $request->file('thumbnail') ){
            $thumbnail = $request->thumbnail;
            $thumbnailImage = $slug . "-" . time() . '.' . $thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(600, 600)->save(public_path('files/products/').$thumbnailImage); 
        }

        // Multiple Image
        $images = array();
        if( $request->hasFile('images') ){
            foreach( $request->file('images') as $image ){
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(300, 300)->save(public_path('files/products/').$imageName);               
                array_push($images, $imageName);
            }
            $multiple = json_encode($images);
        }

        $subcategory = SubCategory::find($request->subcategory_id);
        $data = [
            "product_name"      => $request->product_name,
            "product_slug"      => $slug,
            "product_code"      => $request->product_code,
            'category_id'       => $subcategory->category_id,
            "subcategory_id"    => $request->subcategory_id,
            "child_category_id" => $request->child_category_id,
            "brand_id"          => $request->brand_id,
            "pickup_point_id"   => $request->pickup_point_id,
            "product_unit"      => $request->product_unit,
            "product_tags"      => $request->product_tags,
            "purchase_price"    => $request->purchase_price,
            "selling_price"     => $request->selling_price,
            "discount_price"    => $request->discount_price,
            "warehouse"         => $request->warehouse,
            "stock_quantity"    => $request->stock_quantity,
            "product_color"     => $request->product_color,
            "product_size"      => $request->product_size,
            "description"       => $request->description,
            "video"             => $request->video,            
            "featured"          => $request->featured,
            "today_deal"        => $request->today_deal,
            "product_slider"    => $request->product_slider,
            "trendy"            => $request->trendy,  
            "status"            => $request->status,  
            'admin_id'          => Auth::user('admin')->id,
            'date'              => date('d-m-Y'),
            'month'             => date('F'),
            'thumbnail'         => $thumbnailImage,
            'images'            => $multiple
        ];
       
        Product::create($data);
        $notification = array('message' =>'Product Added Successfully.', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
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
        
        $product          = Product::find($id);
        $categoires       = Category::all();
        $child_categoires = ChildCategory::where('category_id', $product->category_id)->get();
        $warehouse        = Warehouse::all();
        $brand            = Brand::all();
        $pickup_point     = PickupPoint::all();
        
        return view('admin.product.edit_product', compact('product','categoires', 'child_categoires','warehouse', 'brand', 'pickup_point'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            "product_name"      => 'required',
            "product_code"      => 'required|max:255|unique:products,product_code,'.$id,
            "subcategory_id"    => 'required',
            "child_category_id" => 'required',
            "brand_id"          => 'required',
            "product_unit"      => 'required',
            "selling_price"     => 'required',
            "warehouse"         => 'required',
        ]);
        $slug = Str::slug($request->product_name, '-');        
        $subcategory = SubCategory::find($request->subcategory_id);
        $data = [
            "product_name"      => $request->product_name,
            "product_slug"      => $slug,
            "product_code"      => $request->product_code,
            'category_id'       => $subcategory->category_id,
            "subcategory_id"    => $request->subcategory_id,
            "child_category_id" => $request->child_category_id,
            "brand_id"          => $request->brand_id,
            "pickup_point_id"   => $request->pickup_point_id,
            "product_unit"      => $request->product_unit,
            "product_tags"      => $request->product_tags,
            "purchase_price"    => $request->purchase_price,
            "selling_price"     => $request->selling_price,
            "discount_price"    => $request->discount_price,
            "warehouse"         => $request->warehouse,
            "stock_quantity"    => $request->stock_quantity,
            "product_color"     => $request->product_color,
            "product_size"      => $request->product_size,
            "description"       => $request->description,
            "video"             => $request->video,            
            "featured"          => $request->featured,
            "today_deal"        => $request->today_deal,
            "product_slider"    => $request->product_slider,
            "trendy"            => $request->trendy,
            "status"            => $request->status,
            'admin_id'          => Auth::user('admin')->id,
            'date'              => date('d-m-Y'),
            'month'             => date('F'),
           
        ];
        // Thumbnail Image
        if( $request->file('thumbnail') ){
            $image_path = public_path('files/products/'.$request->old_thumbnail);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        
            $thumbnail = $request->thumbnail;
            $thumbnailImage = $slug .'.' . $thumbnail->getClientOriginalExtension();            
            Image::make($thumbnail)->resize(600, 600)->save(public_path('files/products/').$thumbnailImage);
            $data['thumbnail'] = $thumbnailImage;
        }

        // Multiple Image
        if( $request->old_images ){
            $images = $request->old_images;
            $data['images'] = json_encode($images);  
               
        }
        else{
            $images = array();
            $data['images'] = json_encode($images); 
        }

        if( $request->hasFile('images') ){                 
            foreach( $request->file('images') as $image ){
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(300, 300)->save(public_path('files/products/').$imageName);               
                array_push($images, $imageName);
            }
            $data['images'] = json_encode($images);
                   
        }

        Product::where('id', $id)->update($data);
        $notification = array('message' =>'Product Update Successfully.', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Product::find($id);

        // Delete Thumbnail Image
        $thumbnail_path = public_path('files/products/'.$delete->thumbnail);
        if(File::exists($thumbnail_path)) {
            File::delete($thumbnail_path);
        }

        // Delete Multiple Image
        $images = json_decode($delete->images);
        foreach($images as $image){
            $image_path = public_path('files/products/'.$image);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        
        $delete->delete();
        return response()->json(['success'=> 'Product delete successfully.']);
    }

    // Ajax resquest receive for controller and send for childcategory
    public function childcategory(string $id){
        $childcategory = ChildCategory::where('subcategory_id', $id)->get();
        return response()->json($childcategory);
    }

    // Ajax Featured Deactive 
    public function featured_deactive($id){
        $update = Product::findOrFail($id);
        $update->update(['featured' => 0]);        
        return response()->json('Deactive successfully.');
    }
    // Ajax Featured Active 
    public function featured_active($id){
        $update = Product::findOrFail($id);
        $update->update(['featured' => 1]);        
        return response()->json('Active successfully.');
    }

    // Ajax Today Deal Deactive 
    public function deal_deactive($id){
        $update = Product::findOrFail($id);
        $update->update(['today_deal' => 0]);        
        return response()->json('Deactive successfully.');
    }
    // Ajax Today Deal Aactive 
    public function deal_active($id){
        $update = Product::findOrFail($id);
        $update->update(['today_deal' => 1]);        
        return response()->json('Active successfully.');
    }

    // Ajax Status Deactive 
    public function status_deactive($id){
        $update = Product::findOrFail($id);
        $update->update(['status' => 0]);        
        return response()->json('Deactive successfully.');
    }

    // Ajax Status Aactive 
    public function status_active($id){
        $update = Product::findOrFail($id);
        $update->update(['status' => 1]);        
        return response()->json('Active successfully.');
    }

    // Ajax Slider Deactive 
    public function slider_deactive($id){
        $update = Product::findOrFail($id);
        $update->update(['product_slider' => 0]);        
        return response()->json('Deactive successfully.');
    }

    // Ajax Slider Aactive 
    public function slider_active($id){
        $update = Product::findOrFail($id);
        $update->update(['product_slider' => 1]);        
        return response()->json('Active successfully.');
    }

    // Ajax trendy Deactive 
    public function trendy_deactive($id){
        $update = Product::where('id', $id)->update(['trendy' => 0]);    
        return response()->json('Deactive successfully.');
    }

    // Ajax trendy Aactive 
    public function trendy_active($id){
        $update = Product::where('id', $id)->update(['trendy' => 1]); 
        return response()->json('Active successfully.');
    }
}
