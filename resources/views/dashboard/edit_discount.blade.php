@extends('layouts.dashboard')
@section('content')



<div class="content-body">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
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
            <div class="col-md-4 col-lg-4">
                <form method="POST" action="{{route('update_discount',$discount->id)}}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="first_name">Discount Value (%)</label>
                        <input type="number" class="form-control @error('value') is-invalid @enderror" id="" name="value" value="{{$discount->value}}">
                        @error('value')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">Update Discount</button>
                    </div>

                </form>
            </div>

        </div><!-- col -->
    </div><!-- row -->


</div><!-- container -->
</div>

@endsection