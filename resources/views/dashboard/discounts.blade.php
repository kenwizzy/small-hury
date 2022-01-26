@extends('layouts.dashboard')
@section('content')



<div class="content-body">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">

            @if (session('success'))
            @section('script')
            <script>
                Notiflix.Notify.Success('{{ session("success") }}', {
                    timeout: 6000,
                }, );
            </script>
            @endsection
            @endif
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Discounts</li>
                    </ol>
                </nav>
                <!-- <h4 class="mg-b-0 tx-spacing--1"> All Stores</h4> -->
            </div>
        </div>

        <div class="row row-xs">
            <!-- <div class="col-lg-4 col-xl-4"> -->
            <div class="col-md-4 col-lg-4">
                <form method="POST" action="{{url('add_discount')}}">
                    @csrf

                    <div class="form-group">
                        <label for="first_name">Discount Value (%)</label>
                        <input type="number" class="form-control @error('value') is-invalid @enderror" id="" name="value" value="{{ old('value') }}" autocomplete="off">
                        @error('value')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">Add Discount</button>
                    </div>

                </form>
            </div>


            <div class="col-lg-8 col-xl-8 mg-t-10">
                @if($discounts->count() > 0)
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover mg-b-0" id="basicExample">
                            <thead class="thead-primary">
                                <tr>
                                    <th class="text-center">s/n</th>
                                    <th>Discount Value (%)</th>
                                    <th>Created By</th>
                                    <th class="text-left">Date Created </th>
                                    <th class=" text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach ($discounts as $discount)
                                <tr>
                                    <td class="tx-color-03 tx-center">{{$sn++}}</td>
                                    <td class="tx-medium">{{$discount->value}}%</td>
                                    <td class="tx-medium">{{$discount->user->first_name}} ({{$discount->user->role->name}})</td>
                                    <td class="tx-medium">{{ Carbon\Carbon::parse($discount->created_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ssa') }}</td>
                                    <td class=" text-center">
                                        <div class="dropdown-file"> <a href="" class="dropdown-link" data-toggle="dropdown"><i class="fas fa-plus moove"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('dashboard.edit_discount', $discount->id)}}" class="dropdown-item details"><i class="far fa-clipboard"></i> Edit </a>
                                                <a onclick="event.preventDefault(); confirm('Are you sure you want to delete this discount?');
          document.getElementById('delete-form').submit();" href="{{route('delete_discount', $discount->id)}}" class="dropdown-item details"><i class="far fa-clipboard"></i> Delete </a>
                                                <form id="delete-form" action="{{route('delete_discount', $discount->id)}}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else

                        <h4 class="text-center text-danger">No Record Found</h4>

                        @endif
                    </div><!-- table-responsive -->
                </div><!-- card -->

            </div><!-- col -->
        </div><!-- row -->


    </div><!-- container -->
</div>

@endsection