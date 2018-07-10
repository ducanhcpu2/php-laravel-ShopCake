@extends('master')
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Sản Phẩm {{$sanpham->name}}</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="{{route('trang-chu')}}">Trang Chủ</a> / <span>Product</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		<div class="row">
			<div class="col-sm-9">

				<div class="row">
					<div class="col-sm-4">
						<img src="source/image/product/{{$sanpham->image}}" alt="">
					</div>
					<div class="col-sm-8">
						<div class="single-item-body">
							<p class="single-item-title">{{$sanpham->name}}</p>
							<p class="single-item-price">
							@if($sanpham->promotion_price == 0 )
								<span>{{number_format($sanpham->unit_price)}} đồng</span>
								@else{
								<span class="flash-del">{{number_format($sanpham->unit_price)}} đồng</span>
								<span class="flash-sale">{{number_format($sanpham->promotion_price)}} đồng</span>
								}
							@endif
							</p>
						</div>

						<div class="clearfix"></div>
						<div class="space20">&nbsp;</div>

						<div class="single-item-desc">
							<p>{{$sanpham->description}}</p>
						</div>
						<div class="space20">&nbsp;</div>

						<p>Options:</p>
						<div class="single-item-options">
							<!-- <select class="wc-select" name="size">
								<option>Size</option>
								<option value="XS">XS</option>
								<option value="S">S</option>
								<option value="M">M</option>
								<option value="L">L</option>
								<option value="XL">XL</option>
							</select>
							<select class="wc-select" name="color">
								<option>Color</option>
								<option value="Red">Red</option>
								<option value="Green">Green</option>
								<option value="Yellow">Yellow</option>
								<option value="Black">Black</option>
								<option value="White">White</option>
							</select> -->
							<select class="wc-select" name="color">
								<option>Số Lượng</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
							<a class="add-to-cart" href="{{route('themgiohang',$sanpham->id)}}"><i class="fa fa-shopping-cart"></i></a>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div class="space40">&nbsp;</div>
				<div class="woocommerce-tabs">
					<ul class="tabs">
						<li><a href="#tab-description">Description</a></li>
						<!-- <li><a href="#tab-reviews">Reviews (0)</a></li> -->
					</ul>

					<div class="panel" id="tab-description">
						{{$sanpham->description}}
					</div>
					<div class="panel" id="tab-reviews">
						<p>No Reviews</p>
					</div>
				</div>
				<div class="space50">&nbsp;</div>
				<div class="beta-products-list">
					<h4>Related Products</h4>

					<div class="row">
						@foreach($sp_tuongtu as $tt)
						<div class="col-sm-4">
							<div class="single-item">
								<div class="single-item-header">
									<a href="{{route('chitietsanpham',$tt->id)}}"><img src="source/image/product/{{$tt->image}}" alt="" height="150px"></a>
								</div>
								<div class="single-item-body">
									<p class="single-item-title">{{$tt->name}}</p>
									<p class="single-item-price" style="font-size: 18px">
										@if($tt->promotion_price == 0 )
											<span>{{number_format($tt->unit_price)}} đồng</span>
											@else{
											<span class="flash-del">{{number_format($tt->unit_price)}} đồng</span>
											<span class="flash-sale">{{number_format($tt->promotion_price)}} đồng</span>
											}
										@endif
									</p>
								</div>
								<div class="single-item-caption">
									<a class="add-to-cart pull-left" href="{{route('themgiohang',$tt->id)}}"><i class="fa fa-shopping-cart"></i></a>
									<a class="beta-btn primary" href="{{route('chitietsanpham',$tt->id)}}">Details <i class="fa fa-chevron-right"></i></a>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
					<div class="row">{{$sp_tuongtu->links()}}</div>
				</div> <!-- .beta-products-list -->
			</div>
			<div class="col-sm-3 aside">
				<div class="widget">
					<h3 class="widget-title">Best Sellers</h3>
					<div class="widget-body">
						<div class="beta-sales beta-lists">
							<div class="media beta-sales-item">
								<a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/1.png" alt=""></a>
								<div class="media-body">
									Sample Woman Top
									<span class="beta-sales-price">$34.55</span>
								</div>
							</div>
							<div class="media beta-sales-item">
								<a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/2.png" alt=""></a>
								<div class="media-body">
									Sample Woman Top
									<span class="beta-sales-price">$34.55</span>
								</div>
							</div>
							<div class="media beta-sales-item">
								<a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/3.png" alt=""></a>
								<div class="media-body">
									Sample Woman Top
									<span class="beta-sales-price">$34.55</span>
								</div>
							</div>
							<div class="media beta-sales-item">
								<a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/4.png" alt=""></a>
								<div class="media-body">
									Sample Woman Top
									<span class="beta-sales-price">$34.55</span>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- best sellers widget -->
				<div class="widget">
					<h3 class="widget-title">New Products</h3>
					@foreach($new_product as $new)
					<div class="widget-body">
						<div class="beta-sales beta-lists">
							
							<div class="media beta-sales-item">
								<a class="pull-left" href="{{route('themgiohang',$new->id)}}"><img src="source/image/product/{{$new->image}}" alt=""></a>
								<div class="media-body">
									{{$new->name}}
									<span class="beta-sales-price" style="font-size: 15px">
										@if($new->promotion_price == 0 )
											<span>{{number_format($new->unit_price)}} đồng</span>
											@else{
											<span class="flash-del">{{number_format($new->unit_price)}} đồng</span>
											<span class="flash-sale">{{number_format($new->promotion_price)}} đồng</span>
											}
										@endif
									</span>
								</div>
							</div>
							
						</div>
					</div>
					@endforeach
				</div> <!-- best sellers widget -->
			</div>
		</div>
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection('content')