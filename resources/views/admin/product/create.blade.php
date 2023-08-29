@extends('admin.layouts.app')

@section('title', 'New Product')

@section('admin_content')
<style type="text/css">
    label {
        display: block;
    }
    .bootstrap-tagsinput .tag {        
        width: 100%;
        background: #428bca;
        border: 1px solid white;
        padding: 2px;
        margin-left: 2px;
        color: 2px;
        border-radius: 4px;
    }
</style>
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>New Product</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Add Product</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
         <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add New Product</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        @if ($errors->any())
                            <div class="alert alert-danger mt-2">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body form-row">
                            <div class="form-group col-md-6">
                                <label for="productname">Product Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="product_name" id="productname" value="{{ old('product_name') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="productcode">Product Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="productcode" name="product_code" value="{{ old('product_code') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="productcategory">Category/Subcategory <span class="text-danger">*</span></label>
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option disabled selected>Choose Subcategory</option>
                                    @foreach ($categoires as $row)
                                        <option>{{ $row->name }}</option>
                                        @php
                                            $subcategory = DB::table('sub_categories')->where('category_id', $row->id)->get();
                                        @endphp
                                        @foreach($subcategory as $row)
                                        <option value="{{ $row->id }}">----{{ $row->subcategory_name }}</option>
                                        @endforeach
                                    @endforeach 
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="childcategory">Child Category <span class="text-danger">*</span></label>
                                <select name="child_category_id" id="childcategory" class="form-control">
                                   
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="productbrand">Product Brand <span class="text-danger">*</span></label>
                                <select name="brand_id" id="productbrand" class="form-control">
                                    @foreach ($brand as $row)
                                        <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pickuppoint">Pickup Point</label>
                                <select name="pickup_point_id" id="pickuppoint" class="form-control">
                                    @foreach ($pickup_point as $row)
                                        <option value="{{ $row->id }}">{{ $row->pickup_point_name }}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="productunit">Unit <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="productunit" name="product_unit" value="{{ old('product_unit') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="producttags">Tags</label>
                                <input type="text" class="form-control" name="product_tags" data-role="tagsinput" value="{{ old('product_tags') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="purchaseprice">Purchase Price</label>
                                <input type="text" class="form-control" id="purchaseprice" name="purchase_price" value="{{ old('purchase_price') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sellingprice">Selling Price <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="sellingprice" name="selling_price" value="{{ old('selling_price') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="discountprice">Discount Price</label>
                                <input type="text" class="form-control" id="producttags" name="discount_price" value="{{ old('discount_price') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pwarehouse">Warehouse <span class="text-danger">*</span></label>
                                <select name="warehouse" id="pwarehouse" class="form-control">
                                    @foreach ($warehouse as $row)
                                    <option value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
                                    @endforeach                                    
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pstock">Stock</label>
                                <input type="text" class="form-control" id="pstock" name="stock_quantity" value="{{ old('stock_quantity') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pcolor">Color</label>
                                <input type="text" name="product_color" id="pcolor" data-role="tagsinput" value="{{ old('product_color') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="psize">Size</label>
                                <input type="text" class="form-control" id="psize" name="product_size"  data-role="tagsinput" value="{{ old('product_size') }}"> 
                            </div>                            
                            <div class="form-group col-md-12">
                                <label>Product Details</label>
                                <textarea name="description" class="form-control textarea"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pembedcode">Video Embed Code</label>
                                <input type="text" class="form-control" id="pembedcode" name="video" value="{{ old('video') }}">
                            </div>
                        </div>
                       
                </div>
            <!-- /.card -->
            </div>
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="pthumbnail">Thumbnail</label>
                            <input type="file" class="form-control dropify" id="pthumbnail" name="thumbnail">
                        </div>
                        <div class="">
                            <table class="table table-borderd" id="dynamic_field">
                                <div class="card-header">
                                    <h3 class="card-title">More Images (Click Add for more images)</h3>
                                </div>
                                <tr>
                                    <td><input type="file" class="form-control name_list" accept="image/*" name="images[]"></td>
                                    <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>
                                </tr>
                            </table>
                        </div>
                        <div class="card p-4">
                            <label for="featured">Featured Product</label>
                            <input type="checkbox" name="featured" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                        </div>
                        <div class="card p-4">
                            <label for="todaydela">Today Deal</label>
                            <input type="checkbox" name="today_deal" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                        </div>
                        <div class="card p-4">
                            <label for="product_slider">Product Slider</label>
                            <input type="checkbox" name="product_slider" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                        </div>
                        <div class="card p-4">
                            <label for="trendy_product">Trendy Product</label>
                            <input type="checkbox" name="trendy" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                        </div>
                        <div class="card p-4">
                            <label for="status">Status</label>
                            <input type="checkbox" name="status" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                        </div>
                    </div>
                </div>
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
         <!-- /.card-body -->        
         <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    </div><!-- /.container-fluid -->
</section>

@push('script')
<script src="{{ asset('assets') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="{{ asset('assets') }}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript">
        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });

        // Dropify upload image
        $('.dropify').dropify();

        // bootstrap switch
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        // Multiple Image Add
        $(document).ready(function(){
            var postURL = "<?php echo url('admore');?>";
            var i= 1
	
            $('#add').click(function(){
                i++
                $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" accept="image/*" name="images[]" placeholder="Enter your Name" class="form-control name_list"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');        
	        });

            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr('id');
                $('#row'+button_id+'').remove();
            });
        });

        // Ajax resquest send for childcategory
        $('#subcategory_id').change(function(){
            var id = $(this).val();
            $.ajax({
                url: "/get-child-category" + '/' + id,
                type: "GET",
                success: function(response){                   
                    
                    var options = '';
                    $.each(response, function(key, value) { 
                        console.log(response);
                        options += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $('#childcategory').html(options); 
                }
            });
        });

        
    </script>
@endpush
@endsection