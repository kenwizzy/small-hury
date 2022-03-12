@extends('layouts.dashboard')
@section('content')


<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="{{asset('assets/img/small-hurry.jpeg')}}" width="90" /><span>SMALL HURRY</span>
								</td>

								<td>
									Invoice #: {{$order->id}}<br/>
									Created: {{ Carbon\Carbon::parse($order->created_at, 'UTC')->isoFormat('MMMM Do YYYY') }}<br />
									<!-- Due: February 1, 2015 -->
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
                                Plot 1384, Efab Verizon Estate,<br> 
                                Gwarinpa, Abuja.
								</td>

								<td>
									{{$order->customer->first_name.' '.$order->customer->last_name}}<br />
									{{$order->delivery->address->street}}<br />
									{{$order->delivery->address->landmark}}<br>
                                    {{$order->delivery->address->city.', '.$order->delivery->address->state.', '.$order->delivery->address->country}}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Payment Details</td>

					<td></td>
				</tr>

				<tr class="details">
					<td>Payment Method</td>

					<td>{{$order->delivery->payment_method}}</td>
				</tr>

                <tr class="details">
					<td>Payment Status</td>

					<td>{{$order->payment_status==1?'Paid':'Not Paid'}}</td>
				</tr>

				<tr class="heading">
					<td>Item</td>

					<td>Price</td>
				</tr>

				<tr class="item">
                @foreach($order->order_details as $item)
					<td>{{$item->product_name.' ('.$item->quantity.')'}}</td>
                
					<td>&#8358;{{$item->product->real_price * $item->quantity}}</td>
                @endforeach
				</tr>
				<tr class="item last">
					<td>Shipping Price</td>

					<td>&#8358;{{number_format($order->total_shipping_price,2)}}</td>
				</tr> 
                <tr class="item last">
					<td>Total Product Price</td>

					<td>&#8358;{{number_format($order->total_products_price,2)}}</td>
				</tr> 

				<tr class="total">
					<td></td>

					<td>Total: &#8358;{{number_format($order->total_paid,2)}}</td>
				</tr>
			</table>
		</div>

@endsection