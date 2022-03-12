@extends('layouts.dashboard')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/dashboard/assets/css/dashforge.filemgr.css') }}">
<div class="content-body">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Order</li>
                        <li class="breadcrumb-item activePage" aria-current="page">details</li>
                    </ol>

                </nav>
                <h4 class="mg-b-0 tx-spacing--1">Order Details</h4>
            </div>
        </div>

        <div class="row row-xs">
            <div class="col-lg-12 col-xl-12 mg-t-10">

                <div class="row">
                    <div class="col-md-9">

                    </div>

                    <div class="col-md-3">
                        @if($order->status == 1)
                        <a href="javascript:void(0)" id="updateOrder" class="btn btn-primary btn-icon">Start Processing</a>
                        @else
                        <a href="javascript:void(0)" class="btn btn-primary" style="background-color:#001737;">{{$order->starus->name}}</a>
                        @endif
                        <a href="javascript:void(0)" id="back-btn" class="btn btn-primary btn-icon">Go Back</a>
                    </div>
                </div>
                <div class="divider-text">Details</div>
                <br>
                <table class="table table-striped table-sm mg-b-0">
                    <tbody>
                        <tr>
                            <td class="">Order Reference</td>
                            <td class="" id="order">{{$order->id}}</td>
                        </tr>
                        <tr>
                            <td class="">Placed on:</td>
                            <td class="">{{ Carbon\Carbon::parse($order->created_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ssa') }}</td>
                        </tr>
                        <tr>
                            <td class="">Total Item:</td>
                            <td class="">{{$count}}</td>
                        </tr>
                        <tr>
                            <td class="">Item Name</td>
                            <td class="">
                                @foreach($order->order_details as $item)
                                {{$item->product->name}}({{$item->quantity}})&nbsp;&nbsp;
                                @endforeach
                            </td>

                        <tr>
                            <td class="">Item Images</td>
                            <td class="tx-medium">
                                @foreach($order->order_details as $item)
                                <img width="100" src="{{$item->product->DefaultImage->image_url}}">&nbsp;&nbsp;&nbsp;&nbsp;
                                @endforeach
                            </td>

                        </tr>
                        <tr>

                            <td class="">Amount:</td>
                            <td class="">&#8358;{{$order->total_products_price}}</td>
                        </tr>
                        <tr>
                            <td class="">Shipping Fee:</td>
                            <td class="">&#8358;{{$order->total_shipping_price}}</td>
                        </tr>
                        <tr>
                            <td class="">Total Amount:</td>
                            <td class="">&#8358;{{$order->total_paid}}</td>
                        </tr>
                        <tr>
                            <td class="">Payment Method:</td>
                            <td class="">{{$order->delivery->payment_method}}</td>
                        </tr>

                    </tbody>
                </table>

                {{--<table class="table table-striped table-sm mg-b-0">
                    <div class="divider-text">Payment Details</div>
                    <tbody>
                        
                    </tbody>
                </table>--}}
                <table class="table table-striped table-sm mg-b-0">
                    <tbody>
                        <div class="divider-text">Delivery Details</div>

                        <tr>
                            <td>Customer Name</td>
                            <td class="">{{$order->customer->first_name.' '.$order->customer->last_name}}</td>
                        </tr>
                        <tr>
                            <td class="">Delivery Contact:</td>
                            <td class="">{{$order->delivery->delivery_contact}}</td>
                        </tr>
                        <tr>
                            <td class="">Delivery Phone:</td>
                            <td class="">{{$order->delivery->delivery_phone}}</td>
                        </tr>

                        <tr>
                            <td class="">Delivery Note:</td>
                            <td class="">{{$order->delivery->delivery_note}}</td>
                        </tr>
                        <tr>
                            <td class="">Delivery Date:</td>
                            <td class="">{{$order->delivery->delivery_date}}</td>
                        </tr>
                        <tr>
                            <td class="">Delivery Street:</td>
                            <td class="">{{$order->delivery->address->street}}</td>
                        </tr>
                        <tr>
                            <td class="">Delivery Landmark:</td>
                            <td class="">{{$order->delivery->address->landmark}}</td>
                        </tr>
                        <tr>
                            <td class="">Delivery City:</td>
                            <td class="">{{$order->delivery->address->city}}</td>
                        </tr>
                        <tr>
                            <td class="">Delivery State:</td>
                            <td class="">{{$order->delivery->address->state}}</td>
                        </tr>
                        <tr>
                            <td class="">Delivery Country:</td>
                            <td class="">{{$order->delivery->address->country}}</td>
                        </tr>

                    </tbody>
                </table>

                @endsection

                @section('script')
                <script>
                    $(document).ready(function() {

                        $('#back-btn').on('click', function(e) {
                            e.preventDefault();
                            window.history.back();
                        });

                        $('#updateOrder').on('click', function() {
                            let order_id = $('#order').html();
                            axios.get('{{url("process_order")}}/' + order_id)
                                .then(response => {
                                    console.log(response.data.message);
                                    if (response.data.status == 'success') {
                                        Notiflix.Notify.Success(response.data.message, {
                                            timeout: 6000,
                                        }, );
                                    }else{

                                    Notiflix.Notify.Failure(response.data.message, {
                                            timeout: 6000,
                                        }, );

                                    }

                                });
                        });

                    });
                </script>
                @endsection