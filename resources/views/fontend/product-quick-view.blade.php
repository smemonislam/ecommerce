@php
    $color  = explode(',', $product->product_color);
	$size  	= explode(',', $product->product_size);
@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <img class="img-fluid" src="{{ asset('files/products/'.$product->thumbnail) }}" alt="{{ $product->product_name }}">
        </div>
        <div class="col-lg-8">
            <h3 class="product_name">{{ $product->product_name }}</h3>
            <h5 class="product_category">{{ $product->category->name }} > {{ $product->subcategory->subcategory_name }}</h5>
            <div class="product_category">Brand: {{ $product->brand->brand_name }}</div>
            <div class="mb-2">Price: {{$setting->currency}}{{ $product->selling_price }}</div>
            <div class="d-flex">
               
                <div class="product-size w-100 pr-2">
                    <form action="#">
                        <label >Pick Size</label>
                        <select name="product_size" id="" class="custom-select form-control">  
                            @foreach($size as $row)                                  
                                <option value="{{ $row }}">{{ $row }}</option>     
                            @endforeach                       
                        </select>
                    </form>
                </div>
                
                <div class="product-color w-100">
                    <form action="#">
                        <label >Pick Color</label>
                        <select name="product_color" id="" class="custom-select form-control">
                            @foreach($color as $row)                                  
                                <option value="{{ $row }}">{{ $row }}</option>     
                            @endforeach 
                        </select>
                    </form>
                </div>                        
            </div>
            <div class="order_info d-flex flex-row mt-3">
                <form action="#">                            
                    <div class="button_container">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-info"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>