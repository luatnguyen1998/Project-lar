@extends('frontend.master')
@section('title','Cart')
@section('main')

					<div id="wrap-inner">
						@if(Cart::count()>=1)
						<div id="list-cart">
							<h3>Giỏ hàng</h3>
							<form>
								<table class="table table-bordered .table-responsive text-center">
									<tr class="active">
										<td width="11.111%">Ảnh mô tả</td>
										<td width="22.222%">Tên sản phẩm</td>
										<td width="22.222%">Số lượng</td>
										<td width="16.6665%">Đơn giá</td>
										<td width="16.6665%">Thành tiền</td>
										<td width="11.112%">Xóa</td>
									</tr>
									@foreach($keys as $key)
									<tr>
										<td><img class="img-responsive" src="{{asset('lib/storage/app/product/'.$key->options->img)}}" width="75px" height="75px"></td>
										<td>{{$key->name}}</td>
										<td>
											<div class="form-group">
												<input class="form-control" type="number" value="{{$key->qty}}" onchange="updateCart(this.value,'{{$key->rowId}}')">
											</div>
										</td>
										<td><span class="price">{{number_format($key->price,'0','.','.')}} đ</span></td>
										<td><span class="price"> {{number_format($key->price *$key->qty,'0','.','.')}}đ</span></td>
										<td><a href="{{asset('cart/delete/'.$key->rowId)}}">Xóa</a></td>
									</tr>
								@endforeach
								</table>
								<div class="row" id="total-price">
									<div class="col-md-6 col-sm-12 col-xs-12">										
											Tổng thanh toán: <span class="total-price">{{$total}} đ</span>
																													
									</div>
									<div class="col-md-6 col-sm-12 col-xs-12">
										<a href="#" class="my-btn btn">Mua tiếp</a>
										<a href="#" class="my-btn btn">Cập nhật</a>
										<a href="{{asset('cart/delete/all')}}" class="my-btn btn">Xóa giỏ hàng</a>
									</div>
								</div>
							</form>             	                	
						</div>
						<div id="xac-nhan">
							<h3>Xác nhận mua hàng</h3>
							<form method="post">
								<div class="form-group">
									<label for="email">Email address:</label>
									<input required type="email" class="form-control" id="email" name="email">
								</div>
								<div class="form-group">
									<label for="name">Họ và tên:</label>
									<input required type="text" class="form-control" id="name" name="name">
								</div>
								<div class="form-group">
									<label for="phone">Số điện thoại:</label>
									<input required type="number" class="form-control" id="phone" name="phone">
								</div>
								<div class="form-group">
									<label for="add">Địa chỉ:</label>
									<input required type="text" class="form-control" id="add" name="add">
								</div>
								<div class="form-group text-right">
									<button type="submit" class="btn btn-default">Thực hiện đơn hàng</button>
								</div>
								{{ csrf_field() }}
							</form>
						</div>
						@else
						Chưa Có Sản Phẩm Cần Mua
						@endif
						
					</div>

@stop