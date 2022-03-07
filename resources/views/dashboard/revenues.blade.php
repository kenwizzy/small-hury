@extends('layouts.dashboard')
@section('content')



<div class="content-body">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                        <li class="breadcrumb-item activePage" aria-current="page">Total Revenues</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0 tx-spacing--1">Total Revenues</h4>
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
        <div class="col-sm-4 col-lg-4">
        <div class="card card-body">
          <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total Revenues</h6>
          <div class="d-flex d-lg-block d-xl-flex align-items-end">
            <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">&#8358;{{number_format($orders->SUM('total_paid'),2)}}</h3>

          </div>
          <div class="chart-three">
            <div id="flotChart3" class="flot-chart ht-30"></div>
          </div><!-- chart-three -->
        </div>
      </div><!-- col -->
      <div class="col-sm-4 col-lg-4">
        <div class="card card-body">
          <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Online Payments</h6>
          <div class="d-flex d-lg-block d-xl-flex align-items-end">
            <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">&#8358;{{number_format($onlineOrders,2)}}</h3>

          </div>
          <div class="chart-three">
            <div id="flotChart4" class="flot-chart ht-30"></div>
          </div><!-- chart-three -->
        </div>
      </div><!-- col -->
      <div class="col-sm-4 col-lg-4">
        <div class="card card-body">
          <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Pay On Delivery</h6>
          <div class="d-flex d-lg-block d-xl-flex align-items-end">
            <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">&#8358;{{number_format($podOrders,2)}}</h3>

          </div>
          <div class="chart-three">
            <div id="flotChart5" class="flot-chart ht-30"></div>
          </div><!-- chart-three -->
        </div>
      </div><!-- col -->
      
            <div class="col-lg-12 col-xl-12 mg-t-10">
                <div class="card mg-b-10">
                    <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                        <div>
                            <p class="tx-13 tx-color-03 mg-b-0">This table displays a all <strong>Revenues
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
                                        Total Revenues</h6>
                                    <h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">{{$orders->count()}}</h4>
                                </div>
                            </div>

                        </div>
                    </div><!-- card-body -->
                    
            <div class="col-12 justify-content-center text-center align-items-center">
                <a href="{{route('dashboard/export')}}" class="btn btn-primary float-right"><i class="fas fa-file"></i>Export</a>
            </div>

                    <div class="table-responsive">

                        <table class="table table-hover mg-b-0" id="basicExample">
                            
                            <thead class="thead-primary">
                                <tr>
                                    <th class="text-center">s/n</th>
                                    <th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Product</th>
                                    <th>Total Price</th>
                                    <th>Payment Method</th>
                                    <th>Payment Status</th>
                                    {{--<th>Order Status</th>
                                    <th>Updated By</th>
                                    <th class="text-left">Orde Date</th>
                                    <th class="text-left">Date Updated</th>
                                    <th class=" text-center">Action</th>--}}
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach($orders as $order)
                    
                                <tr>
                                    <td class="tx-color-03 tx-center">{{$sn++}}</td>
                                    <td class="tx-medium">{{$order->id}}</td>
                                    <td class="tx-medium">{{$order->customer->first_name.' '.$order->customer->last_name}}</td>
                                    <td class="tx-medium">
                                    @foreach($order->order_details as $item)
                                      {{$item->product->name}} ({{$item->quantity}})&nbsp;&nbsp;
                                    @endforeach
                                    </td>
                                    <td class="text-left">&#8358;{{number_format($order->total_paid,2)}}</td>
                                    <td class="text-left">{{$order->delivery->payment_method??''}}</td>
                                    <td class="text-left">{{$order->payment_status==0?'Not Paid':'Paid'}}</td>
                                    {{--<td class="text-left">{{$order->starus->name}}</td>
                                    <td class="text-left">{{$order->update_by != 0 ? $order->user->first_name.' '.$order->user->last_name.' ('.$order->user->role->name.')' : ''}}</td>
                                    <td class="tx-medium">{{ Carbon\Carbon::parse($order->created_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ssa') }}</td>
                                    <td class="tx-medium">{{ Carbon\Carbon::parse($order->updated_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ssa') }}</td>--}}
                                    
                                </tr>
                                
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