@extends('fontend.layouts.app')
    @push('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('fontend') }}/styles/product_styles.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('fontend') }}/styles/product_responsive.css">
		<style>
			.checked {
				color: orange;
			}
		</style>
    @endpush

@section('menu')    
    @include('fontend.partials.collapse-navigation')
@endsection

@section('content')
    <!-- Single Product -->
@php
	$sum_rating = DB::table('reviews')->where('product_id', $product->id)->sum('rating');
	$rating = DB::table('reviews')->where('product_id', $product->id)->count('rating');
	
	$rating_5 = DB::table('reviews')->where('rating', 5)->count('rating');
	$rating_4 = DB::table('reviews')->where('rating', 4)->count('rating');
	$rating_3 = DB::table('reviews')->where('rating', 3)->count('rating');
	$rating_2 = DB::table('reviews')->where('rating', 2)->count('rating');
	$rating_1 = DB::table('reviews')->where('rating', 1)->count('rating');

	$images = json_decode($product->images);
	$color  = explode(',', $product->product_color);
	$size  	= explode(',', $product->product_size);
	
@endphp
	<div class="single_product">
		<div class="container">
			<div class="row">
				<!-- Images -->
				<div class="col-lg-2 order-lg-1 order-2">
					<ul class="image_list">
                        @foreach ($images as $image)                            
						<li data-image="{{ asset('files/products/'.$image ) }}"><img src="{{ asset('files/products/'.$image ) }}" alt="Image Not Found!"></li>
                        @endforeach
					</ul>
				</div>

				<!-- Selected Image -->
				<div class="col-lg-5 order-lg-2 order-1">
					<div class="image_selected"><img src="{{ asset('files/products/'.$product->thumbnail ) }}" alt="{{ $product->product_name }}"></div>
				</div>

				<!-- Description -->
				<div class="col-lg-5 order-3">
					<div class="product_description">
						<div class="product_category">{{ $product->category->name }} > {{ $product->subcategory->subcategory_name }}</div>
						<div class="product_name">{{ $product->name }}</div>
                        <div class="product_category">Brand: {{ $product->brand->brand_name }}</div>
                        <div class="product_category">Stock: {{ $product->stock_quantity }}</div>
						<div class="rating_r rating_r_4 product_rating">
							@if($sum_rating != NULL)
							@if(intval($sum_rating/$rating) == 5)
								<div>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
								</div>
							@elseif(intval($sum_rating/$rating) >= 4 && intval($sum_rating/$rating) < 5)
								<div>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star"></span>
								</div>
							@elseif(intval($sum_rating/$rating) >= 3 && intval($sum_rating/$rating) < 4)
								<div>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
								</div>
							@elseif(intval($sum_rating/$rating) >= 2 && intval($sum_rating/$rating) < 3)
								<div>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
								</div>
							@else
								<div>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
								</div>
							@endif
							@endif
						</div>
                        @if($product->discount_price == null)
                            <div class="banner_price">{{$setting->currency}}{{ $product->selling_price }}</div>
                        @else 
                            <div class="banner_price"><span>{{$setting->currency}}{{ $product->selling_price }}</span>{{$setting->currency}}{{ $product->discount_price }}</div>
                        @endif
						
						<div class="d-flex mt-2">
							@isset($product->product_size)
							<div class="product-size w-100 pr-2">
								<form action="#">
									<label >Pick Size</label>
									<select name="" id="" class="form-control">
										@foreach($size as $row)
										<option value="{{ $row }}">{{ $row }}</option>
										@endforeach
									</select>
								</form>
							</div>
							@endisset
							@isset($product->product_color)
							<div class="product-color w-100">
								<form action="#">
									<label >Pick Color</label>
									<select name="" id="" class="form-control">
										@foreach($color as $row)
										<option value="{{ $row }}">{{ $row }}</option>
										@endforeach
									</select>
								</form>
							</div>
							@endisset
						</div>
						{{-- <div class="product_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum. laoreet turpis, nec sollicitudin dolor cursus at. Maecenas aliquet, dolor a faucibus efficitur, nisi tellus cursus urna, eget dictum lacus turpis.</p></div> --}}
						<div class="order_info d-flex flex-row">
							<form action="#">
								<div class="clearfix" style="z-index: 1000;">
									<!-- Product Quantity -->
									<div class="product_quantity clearfix">
										<span>Quantity: </span>
										<input id="quantity_input" type="text" pattern="[0-9]*" value="1">
										<div class="quantity_buttons">
											<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
											<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
										</div>
									</div>
								</div>
								<div class="button_container">
									<div class="input-group">
										<div class="input-group-append">
											<button type="button" class="btn btn-outline-info"><i class="fas fa-cart-plus"></i> Add to Cart</button>
											<button class="btn btn-outline-primary addWishlist" data-id="{{ $product->id }}"><i class="far fa-heart"></i> Add to Wishlist</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-md-12">
					<nav class="w-100">
						<div class="nav nav-tabs" id="product-tab" role="tablist">
						  <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
						  <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Review & Rating</a>
						</div>
					</nav>
					<div class="tab-content p-3" id="nav-tabContent">
						<div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
							{!! $product->description !!} 						
						</div>
						<div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
							<div class="mt-2 mb-3">
								<h3 class="text-center">Rating & Reviews of {{ $product->product_name }}</h3>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="row">
										<div class="col-lg-8">
											<h5>Rating & Reviews of {{ $product->product_name }}</h5>
											@if($sum_rating != NULL)
											@if(intval($sum_rating/$rating) == 5)
												<div>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
												</div>
											@elseif(intval($sum_rating/$rating) >= 4 && intval($sum_rating/$rating) < 5)
												<div>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star"></span>
												</div>
											@elseif(intval($sum_rating/$rating) >= 3 && intval($sum_rating/$rating) < 4)
												<div>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
												</div>
											@elseif(intval($sum_rating/$rating) >= 2 && intval($sum_rating/$rating) < 3)
												<div>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
												</div>
											@else
												<div>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
												</div>
											@endif
											@endif
										</div>
										<div class="col-lg-4">
											<div>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span>Total {{ $rating_1 }}</span>
											</div>
											<div>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span>Total {{ $rating_2 }}</span>
											</div>
											<div>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span>Total {{ $rating_3 }}</span>
											</div>
											<div>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star"></span>
												<span>Total {{ $rating_4 }}</span>
											</div>
											<div>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span>Total {{ $rating_5 }}</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<form action="{{ route('product.review.store') }}" method="POST">
										@csrf
										<input type="hidden" name="product_id" value="{{ $product->id }}">
										<div class="form-group">
											<label>Write your Review</label>
											<textarea name="review" class="form-control" id="" cols="20" rows="5"></textarea>
										</div>
										<div class="form-group">
											<label>Write your Review</label>
											<select name="rating" id="" class="form-control" style="width: 100%">
												<option value="1">1 Star</option>
												<option value="2">2 Star</option>
												<option value="3">3 Star</option>
												<option value="4">4 Star</option>
												<option value="5">5 Star</option>
											</select>
										</div>
										@if(Auth::check())
										<button type="submit" class="btn btn-info btn-sm"><span class="fa fa-star"></span> Review Submit</button>
										@else
											<div>Please at first login to your account for a submit review.</div>
										@endif
										
									</form>
								</div>
							</div>							
							<strong>All reviw of {{ $product->product_name }}</strong>
							<div class="row">
								@foreach($reviews as $reivew)
								<div class="col-lg-6 mt-3">
									<div class="card">
										<div class="card-header">
											{{ $reivew->user->name }} ({{ date('d F, Y'), strtotime($reivew->reivew_date) }})
										</div>
										<div class="card-body">
											{{ $reivew->review }}
											
											@if($reivew->rating == 5)
												<div>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
												</div>
											@elseif($reivew->rating == 4)
												<div>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star"></span>
												</div>
											@elseif($reivew->rating == 3)
												<div>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
												</div>
											@elseif($reivew->rating == 2)
												<div>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
												</div>
											@else
												<div>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
												</div>
											@endif
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>	
					</div>		
				</div>
			</div>
		</div>
	</div>

	<!-- Recently Viewed -->

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Related Product</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container">
						
						<!-- Recently Viewed Slider -->

						<div class="owl-carousel owl-theme viewed_slider">
							
							@foreach($related_product as $row)
							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="{{asset('files/products/'. $row->thumbnail)}}" alt=""></div>
									<div class="viewed_content text-center">
										@if($row->discount_price == null)
										<div class="viewed_price">{{$setting->currency}}{{ $row->selling_price }}</div>
										@else
											<div class="viewed_price">{{$setting->currency}}{{ $row->selling_price }}<span>{{$setting->currency}}{{ $row->discount_price }}</span></div>
										@endif
										<div class="viewed_name"><a href="{{ route('product.details', $row->product_slug) }}">{{ substr($row->product_name,0,50 )}}</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">new</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>
							@endforeach
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Brands -->

	<div class="brands">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="brands_slider_container">
						
						<!-- Brands Slider -->

						<div class="owl-carousel owl-theme brands_slider">
							
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('fontend')}}/images/brands_1.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('fontend')}}/images/brands_2.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('fontend')}}/images/brands_3.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('fontend')}}/images/brands_4.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('fontend')}}/images/brands_5.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('fontend')}}/images/brands_6.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('fontend')}}/images/brands_7.jpg" alt=""></div></div>
							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset('fontend')}}/images/brands_8.jpg" alt=""></div></div>

						</div>
						
						<!-- Brands Slider Navigation -->
						<div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
						<div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
						<div class="newsletter_title_container">
							<div class="newsletter_icon"><img src="{{asset('fontend')}}/images/send.png" alt=""></div>
							<div class="newsletter_title">Sign up for Newsletter</div>
							<div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
						</div>
						<div class="newsletter_content clearfix">
							<form action="#" class="newsletter_form">
								<input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
								<button class="newsletter_button">Subscribe</button>
							</form>
							<div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


    @push('script')
        <script src="{{ asset('fontend') }}/js/product_custom.js"></script>
		<script>
			// Tab
			$('#myTab').tab('show');
		</script>
    @endpush
	
@endsection