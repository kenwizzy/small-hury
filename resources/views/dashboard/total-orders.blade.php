@extends('layouts.dashboard')
@section('content')



<div class="content-body">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                        <li class="breadcrumb-item activePage" aria-current="page">Total Orders</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0 tx-spacing--1">Total Orders</h4>
            </div>
        </div>

        @if (session('error'))
        @section('script')
        <script>
            Notiflix.Notify.Failure('{{ session("error") }}', {
                timeout: 4000,
            }, );
        </script>
        @endsection
        @endif

        @if(session('success'))
        @section('script')
        <script>
            Notiflix.Notify.Success('{{ session("success") }}', {
                timeout: 4000,
            }, );
        </script>
        @endsection
        @endif

        <div class="row row-xs">
            <div class="col-lg-12 col-xl-12 mg-t-10">
                <div class="card mg-b-10">
                    <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                        <div>
                            <p class="tx-13 tx-color-03 mg-b-0">This table displays a list of all <strong>Orders
                                </strong> in small hurry</p>
                        </div>

                    </div><!-- card-header -->
                    <div class="card-body pd-y-30">
                        <div class="d-sm-flex">
                            <div class="media">
                                <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-teal tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-6">
                                    <i data-feather="bar-chart-2"></i>
                                </div>
                                <div class="media-body">
                                    <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">
                                        Total Orders</h6>
                                    <h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">{{$orders->count()}}</h4>
                                </div>
                            </div>

                        </div>
                    </div><!-- card-body -->
                    <div class="table-responsive">

                        <table class="table table-hover mg-b-0" id="basicExample">
                            <thead class="thead-primary">
                                <tr>
                                    <th class="text-center">s/n</th>
                                    <th>Order ID</th>
                                    <th>Warehouse</th>
                                    <th>Total Product price</th>
                                    <th>Shipping Price</th>
                                    <th>Total Amount</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th class="text-left">Order Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach($orders as $order)
                                @if(Auth::id() == $order->warehouse->user_id || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <tr>
                                    <td class="tx-color-03 tx-center">{{$sn++}}</td>
                                    <td class="tx-medium">{{$order->id}}</td>
                                    <td class="tx-medium">{{$order->warehouse->name}}</td>
                                    <td class="tx-medium">&#8358;{{number_format($order->total_products_price,2)}}</td>
                                    <td class="text-left">&#8358;{{number_format($order->total_shipping_price,2)}}</td>
                                    <td class="text-left">&#8358;{{number_format($order->total_paid,2)}}</td>
                                    <td class="text-left">{{$order->payment_status==0?'Not Paid':'Paid'}}</td>
                                    <td class="text-left">{{$order->starus->name}}</td>
                                    <td class="tx-medium">{{ Carbon\Carbon::parse($order->created_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ssa') }}</td>
                                   
                                    {{--<td class=" text-center">
                                        <div class="dropdown-file"> <a href="" class="dropdown-link" data-toggle="dropdown"><i class="fas fa-plus moove"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('dashboard/order_details',$order->id)}}" class="dropdown-item text-info"><i class="far fa-edit"></i>Order Details </a>
                                                @if($order->status !== 11 && $order->status !== 8 && $order->status !== 7)
                                                <a href="#editService" data-toggle="modal" id="service-order" title="Assign to biker" data-url="{{route('dashboard.get_bikers', $order->id)}}" data-service-name="{{' $order->order_detail->product->name '}}" data-id="{{ '$order->id' }}" class="dropdown-item details text-success"><i class="far fa-user"></i> Assign to biker</a>
                                                @endif
                                                
                                                <a href="{{route('dashboard.declineorder',$order->id)}}" class="dropdown-item text-danger"><i class="far fa-clipboard"></i> Decline Order </a>
                                            </div>
                                        </div>
                                    </td>--}}
                                </tr>

                                @endif 

                                @endforeach

                            </tbody>
                        </table>
                    </div><!-- table-responsive -->
                </div><!-- card -->

            </div><!-- col -->
        </div><!-- row -->


    </div><!-- container -->
</div>

@endsection
@section('script')
<script>
 
</script>

@endsection