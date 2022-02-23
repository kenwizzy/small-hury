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
            <li class="breadcrumb-item" aria-current="page">Products</li>
            <li class="breadcrumb-item activePage" aria-current="page">details</li>
          </ol>

        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Product Details</h4>
      </div>
    </div>

    <div class="row row-xs">
      <div class="col-lg-12 col-xl-12 mg-t-10">

        <div class="row">
          <div class="col-md-9">

          </div>

          <div class="col-md-3">
            <a href="{{route('dashboard/edit_product', $product->id)}}" class="btn btn-primary btn-icon">Edit Product</a>
            <a href="javascript:void(0)" id="back-btn" class="btn btn-primary btn-icon">Go Back</a>
          </div>
        </div>
        <div class="divider-text">Details</div>
        <br>
        <table class="table table-striped table-sm mg-b-0">
          <tbody>
            <tr>
              <td class="">Product Name</td>
              <td class="">{{$product->name}}</td>
            </tr>
            <tr>
              <td class="">Product Category</td>
              <td class="">{{$product->category->name}}</td>
            </tr>
            <tr>
              <td class="">Product Sub Category</td>
              <td class="">{{$product->subCat == null ? 'Unavailable' : $product->subCat->name }}</td>
            </tr>
            <tr>
              <td class="">Product Description</td>
              <td class="">{{$product->description ?? 'Unavailable'}}</td>
            </tr>
            <tr>
              <td class="">Product Amount</td>
              <td class="">&#8358;{{number_format($product->real_price,2) ?? 'Unavailable'}}</td>
            </tr>

            <tr>
              <td class="">Product Quantity</td>
              <td class="">{{Auth::user()->role->name == 'Warehouse Manager' ? $product->productStoreQty()->total_quantity : $product->totalItems()}}</td>
            </tr>
            <tr>
              <td class="">Product Attributes</td>
              <td class="">{{$product->attribute()}}</td>
            </tr>
            <tr>
              <td class="">Uploaded By</td>
              <td class="">{{$product->user->first_name.' '.$product->user->last_name.' ('.$product->user->role->name.')' ?? 'Unavailable'}}</td>
            </tr>
            <tr>
              <td class="">Date Uploaded</td>
              <td class="">{{ Carbon\Carbon::parse($product->created_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ssa') ?? 'Unavailable' }}</td>
            </tr>
          </tbody>
        </table>

        <br>
        <div class="divider-text">Product Images</div>
        <div class="row row-xs">
          <!-- <div class="col-6 col-sm-4 col-md-3">
            <div class="card card-file">
              <img data-magnify="gallery" data-src="" src="{{$product->DefaultImage->image_url}}" width="200" class="img-responsive">
            </div>
          </div> -->

          @foreach($product->productImages as $media)
          <div class="col-6 col-sm-4 col-md-3">
            <div class="card card-file">
              <img data-magnify="gallery" data-src="" src="{{$media->image_url}}" width="200" class="img-fluid h-100" alt="Profile avatar">
            </div>
          </div>
          @endforeach
        </div>

        @endsection

        @section('script')
        <script>
          $(document).ready(function() {

            $('#back-btn').on('click', function(e) {
              e.preventDefault();
              window.history.back();
            });

          });
        </script>
        @endsection