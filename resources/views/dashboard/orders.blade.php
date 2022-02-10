@extends('layouts.dashboard')
@section('content')



<div class="content-body">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Orders</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0 tx-spacing--1">All Orders</h4>
            </div>
        </div>

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
                                    <th>Amount Paid</th>
                                    <th>Status</th>
                                    <th>Updated By</th>
                                    <th class="text-left">Orde Date</th>
                                    <th class="text-left">Date Updated</th>
                                    <th class=" text-center">Action</th>
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
                                    <td class="tx-medium">&#8358;{{$order->total_products_price}}</td>
                                    <td class="text-left">&#8358;{{$order->total_shipping_price}}</td>
                                    <td class="text-left">&#8358;{{$order->total_paid}}</td>
                                    <td class="text-left">{{$order->starus->name}}</td>
                                    <td class="text-left">{{$order->user->first_name.' '.$order->user->last_name.' ('.$order->user->role->name.')' ?? 'Unavailable'}}</td>
                                    <td class="tx-medium">{{ Carbon\Carbon::parse($order->created_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ssa') }}</td>
                                    <td class="tx-medium">{{ Carbon\Carbon::parse($order->updated_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ssa') }}</td>
                                    <td class=" text-center">
                                        <div class="dropdown-file"> <a href="" class="dropdown-link" data-toggle="dropdown"><i class="fas fa-plus moove"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('dashboard/order_details',$order->id)}}" class="dropdown-item text-info"><i class="far fa-edit"></i>Order Details </a>
                                                <a href="#editService" data-toggle="modal" id="service-order" title="Order to biker" data-url="{{route('dashboard.assign_order', $order->id)}}" data-service-name="{{' $order->order_detail->product->name '}}" data-id="{{ '$order->id' }}" class="dropdown-item details text-success"><i class="far fa-user"></i> Assign to biker</a>
                                                {{--<a href="" class="dropdown-item text-success"><i class="far fa-user"></i>Assign to biker</a>--}}
                                                <a href="" class="dropdown-item text-danger"><i class="far fa-clipboard"></i> Decline Order </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                @endif
                                <div class="modal fade" id="editService" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body pd-x-25 pd-sm-x-30 pd-t-40 pd-sm-t-20 pd-b-15 pd-sm-b-20">
                                                <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                                                    <span class="times" aria-hidden="true">&times;</span>
                                                </a>
                                                <div class="modal-body" id="modal-order-body">
                                                    <form method="POST" action="#" enctype="multipart/form-data">
                                                        @csrf
                                                        <h5 class="mg-b-2"><strong>Assigning order with ID <span class="mana"></span> to biker</strong></h5>
                                                        <hr>
                                                        <div class="form-row mt-4">
                                                            <div class="form-group col-md-12">
                                                                <label for="name">Select Biker</label>
                                                                <select id="insert_bikers" class="form-control @error('biker') is-invalid @enderror" name="biker" autocomplete="off">

                                                                </select>
                                                                @error('biker')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Assign</button>

                                                    </form>
                                                    <!-- Modal displays here -->
                                                    <div id="spinner-icon-3"></div>
                                                </div>
                                            </div><!-- modal-body -->
                                        </div><!-- modal-content -->
                                    </div><!-- modal-dialog -->
                                </div><!-- modal -->

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
    $(document).on('click', '#service-order', function(event) {
        event.preventDefault();

        let route = $(this).attr('data-url');
        let id = $(this).attr('data-id');
        let serviceName = $(this).attr('data-service-name');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: route,
            method: 'GET',
            data: {
                "id": id,
                "serviceName": serviceName
            },

            success: function(result) {
                $(".mana").html(result.order.id);
                $.each(result.bikers, function(key, biker) {
                    let bike = `<option value="` + biker.id + `">` + biker.first_name + " " + biker.last_name + `</option>`;
                    console.log(biker);
                    $('#insert_bikers').append(bike);
                });

                $('#modal-order-body').html().show();

            },
            complete: function() {
                $("#spinner-icon-3").hide();
            },
            error: function(jqXHR, testStatus, error) {
                var message = error + ' An error occured while trying to assign order with ID ' + id + ' to biker';
                var type = 'error';
                displayMessage(message, type);
                $("#spinner-icon-3").hide();
            },
            timeout: 8000
        });

    });

    $(document).on('click', '.times', function(event) {
        event.preventDefault();
        $('#insert_manager').html('');
    });
</script>

@endsection