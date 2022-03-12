@extends('layouts.dashboard')
@section('content')



<div class="content-body">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                        <li class="breadcrumb-item activePage" aria-current="page">Invoice Archive</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0 tx-spacing--1">All Invoices</h4>
            </div>
        </div>

        <div class="row row-xs">
            <div class="col-lg-12 col-xl-12 mg-t-10">
                <div class="card mg-b-10">
                    <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                        <div>
                            <p class="tx-13 tx-color-03 mg-b-0">This table displays a list of all <strong>Order Invoices
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
                                        Total Invoices</h6>
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
                                    <th>Total Amount</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th class="text-left">Ordered Date</th>
                                    <th class=" text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach($orders as $order)
                                {{--@if(Auth::id() == $order->warehouse->user_id || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)--}}
                                <tr>
                                    <td class="tx-color-03 tx-center">{{$sn++}}</td>
                                    <td class="tx-medium">{{$order->id}}</td>
                                    <td class="text-left">&#8358;{{number_format($order->total_paid,2)}}</td>
                                    <td class="text-left">
                                        @if($order->payment_status==0)
                                        <button class='btn btn-xs btn-danger'>Not Paid</button>
                                        @else
                                        
                                        <button class="btn btn-xs btn-success">Paid</button>

                                        @endif
                                    </td>
                                    <td class="text-left">{{$order->starus->name}}</td>
                                    <td class="tx-medium">{{ Carbon\Carbon::parse($order->created_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ssa') }}</td>
                                    <td class=" text-center">
                                    
                                
                                    <a href="{{route('dashboard.view-invoice',$order->id)}}"><i class="far fa-file text-success"></i>View</a>                 
                                                
                
                                    </td>
                                </tr>

                                {{--@endif--}}
                                

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
    // for addigning orders to bikers
    // $(document).on('click', '#service-order', function(event) {
    //     event.preventDefault();

    //     let route = $(this).attr('data-url');
    //     let id = $(this).attr('data-id');
    //     let serviceName = $(this).attr('data-service-name');
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     $.ajax({
    //         url: route,
    //         method: 'GET',
    //         data: {
    //             "id": id,
    //             "serviceName": serviceName
    //         },

    //         success: function(result) {
    //             $(".mana").html(result.order.id);
    //             $(".mana1").val(result.order.id);
    //             $.each(result.bikers, function(key, biker) {
    //                 let bike = `<option value="` + biker.id + `">` + biker.first_name + " " + biker.last_name + `</option>`;
    //                 console.log(biker);
    //                 $('#insert_bikers').append(bike);
    //             });

    //             $('#modal-order-body').html().show();

    //         },
    //         complete: function() {
    //             $("#spinner-icon-3").hide();
    //         },
    //         error: function(jqXHR, testStatus, error) {
    //             var message = error + ' An error occured while trying to assign order with ID ' + id + ' to biker';
    //             var type = 'error';
    //             displayMessage(message, type);
    //             $("#spinner-icon-3").hide();
    //         },
    //         timeout: 8000
    //     });

    // });

    // $(document).on('click', '.times', function(event) {
    //     event.preventDefault();
    //     $('#insert_manager').html('');
    // });
</script>

@endsection