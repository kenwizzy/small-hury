@extends('layouts.dashboard')
 @section('content')



 <div class="content-body">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a
                                href="{{url('/')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Stores</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0 tx-spacing--1">{{--\Request::get('status')--}} All Stores</h4>
            </div>
        </div>

        <div class="row row-xs">
            <div class="col-lg-12 col-xl-12 mg-t-10">
                <div class="card mg-b-10">
                    <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                        <div>
                            {{-- <h6 class="mg-b-5">Your Most Recent Requests</h6> --}}
                            <p class="tx-13 tx-color-03 mg-b-0">This table displays a list of all <strong>Stores
                                    </strong> small hurry has</p>
                        </div>

                    </div><!-- card-header -->
                    <div class="card-body pd-y-30">
                        <div class="d-sm-flex">
                            <div class="media">
                                <div
                                    class="wd-40 wd-md-50 ht-40 ht-md-50 bg-teal tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-6">
                                    <i data-feather="bar-chart-2"></i>
                                </div>
                                <div class="media-body">
                                    <h6
                                        class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">
                                        Total Stores</h6>
                                    <h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">9</h4>
                                </div>
                            </div>

                        </div>
                    </div><!-- card-body -->
                    <div class="table-responsive">

                        <table class="table table-hover mg-b-0" id="basicExample">
                            <thead class="thead-primary">
                                <tr>
                                    <th class="text-center">s/n</th>
                                    <th>Store Name</th>
                                    <th>Store Address</th>
                                    <th>LGA</th>
                                    <th class="text-left">State</th>
                                    <th>Total Products</th>
                                    <th>Store Manager</th>
                                    {{-- <th>Attributes</th>
                                    <th>Added by</th> --}}
                                    <th class="text-left">Date Created </th>
                                    <th class=" text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- @foreach ($requests as $request)--}}
                                    <tr>
                                        <td class="tx-color-03 tx-center">1</td>
                                        <td class="tx-medium">Mega Store</td>
                                        <td class="tx-medium">37 Palm Avenue</td>
                                        <td class="tx-medium">Gbagada LGA</td>
                                        <td class="text-left">Lagos State</td>
                                        <td class="text-left">10</td>
                                        <td class="text-left">Oluseyi Olukanya</td>
                                        <td class="tx-medium">12-12-2021</td>
                                        {{-- <td class="tx-medium">Kenneth (Admin)</td>
                                        <td class="tx-medium">23-11-2021</td> --}}
                                        <td class=" text-center">
                                            <div class="dropdown-file"> <a href="" class="dropdown-link"
                                                    data-toggle="dropdown"><i data-feather="more-vertical"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{url('dashboard/products/details')}}" class="dropdown-item details"><i class="far fa-clipboard"></i> Details </a>
                                <a href="" class="dropdown-item details"><i class="far fa-clipboard"></i> Next Page </a>
                                <a href="" class="dropdown-item details"><i class="far fa-clipboard"></i> Edit </a>
                             </div>
                                            </div>
                                        </td>
                                </tr>


                               {{-- @endforeach --}}

                            </tbody>
                        </table>
                    </div><!-- table-responsive -->
                </div><!-- card -->

            </div><!-- col -->
        </div><!-- row -->


    </div><!-- container -->
</div>

 @endsection

