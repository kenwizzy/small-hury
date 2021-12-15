@extends('layouts.dashboard')
 @section('content')


<div class="content-body">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0 tx-spacing--1">Create New Product</h4>
            </div>

            {{-- <div class="d-md-block">
                <a href="" class="btn btn-primary"><i class="fas fa-users"></i> Admin List</a>
            </div> --}}
        </div>

        {{-- @include('layouts.partials._messages') --}}

        <div class="row row-xs">
            <div class="col-lg-12 col-xl-12">
                <form method="POST" action="{{route('create_product')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ old('product_name') }}" autocomplete="off">
                                @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="last_name">Original Price</label>
                                <input type="number" class="form-control @error('original_price') is-invalid @enderror" id="original_price" name="original_price" value="{{ old('original_price') }}" autocomplete="off">
                                @error('original_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="real_price">Real Price</label>
                                <input type="number" class="form-control @error('real_price') is-invalid @enderror" id="real_price" name="real_price" value="{{ old('real_price') }}" autocomplete="off">
                                @error('real_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Default Image</label>
                                <input type="file" class="form-control @error('default_image') is-invalid @enderror" id="default_image" name="default_image" value="{{ old('default_image') }}" autocomplete="off">
                                @error('default_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Secondary Images</label>
                                <input type="file" class="form-control @error('secondary_image') is-invalid @enderror" id="secondary_image" name="" value="{{ old('secondary_image') }}" autocomplete="off">
                                @error('secondary_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="middle_name">Select Category</label>
                                <select class="form-control" name="product_category" autocomplete="off">
                                   <option value="">Select Category</option>
                                   @foreach ($categories as $cat)
                        <option value="{{$cat->id}}" {{old('cat_id') == $cat->id ? 'selected' : ''}}> {{Str::title($cat->name)}}</option>
                                    @endforeach

                                </select>
                            </div>
                            {{-- <div class="form-group col-md-4">
                                <label for="phone_number">Quantity</label>
                                <input type="number" maxlength="11" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" autocomplete="off">
                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div> --}}
                            {{-- <div class="form-group col-md-4">
                                <label for="role_id">Availability</label>
                                <select class="custom-select @error('role_id') is-invalid @enderror" id="designation" name="role_id">
                                    <option selected value="0">In Stock</option>
                                    <option selected value="0">Out of Stock</option>
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}" {{old('role_id') == $role->id ? 'selected' : ''}}> {{Str::title($role->name)}}</option>
                                    @endforeach

                                </select>
                                @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div> --}}
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="on_sale">On Sale</label>
                                <select class="custom-select @error('on_sales') is-invalid @enderror" id="on_sale" name="on_sales">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('on_sales')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="password">Attributes</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="" placeholder="Attributes">
                                {{-- <small id="passwordHelpBlock" class="form-text text-muted">
                                    Password must be 8 characters at least.
                                    <a href="" class="random-password"> Generate random password </a>
                                </small> --}}
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="confirm_password">Sales Expiry</label>
                                <input type="date" class="form-control @error('expiry') is-invalid @enderror" id="expiry" name="expiry">
                                @error('expiry')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-12" style="margin:auto;">
                                <label for="confirm_password">Product Description</label>
                                <textarea class="form-control @error('desc') is-invalid @enderror" name="desc"></textarea>
                                @error('desc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>

                </form>
            </div>
        </div>
    </div>



 @endsection

