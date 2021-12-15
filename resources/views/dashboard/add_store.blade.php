@extends('layouts.dashboard')
 @section('content')


<div class="content-body">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Store</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0 tx-spacing--1">Create New Store</h4>
            </div>
        </div>

        <div class="row row-xs">
            <div class="col-lg-12 col-xl-12">
                <form method="POST" action="">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="first_name">Store Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="" autocomplete="off">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="middle_name">State</label>
                                <select class="form-control" name="middle_name" autocomplete="off" placeholder="">
                                   <option>Select State</option>
                                   <option>Abia</option>
                                   <option>Lagos</option>
                                   <option>Akure</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="middle_name">LGA</label>
                                <select class="form-control" name="middle_name" autocomplete="off" placeholder="">
                                   <option>Select LGA</option>
                                   <option>Mushin</option>
                                   <option>Ikate</option>
                                   <option>Ukwe</option>
                                </select>
                            </div>

                        </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="first_name">Address</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="" autocomplete="off">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="password">Zip code</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Attributes">
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
                            <div class="form-group col-md-3">
                                <label for="confirm_password">Longitude</label>
                                <input type="text" class="form-control @error('expiry') is-invalid @enderror" id="expiry" name="expiry">
                                @error('expiry')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group col-md-3">
                                <label for="first_name">Laditude</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="" autocomplete="off">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">Add Store</button>
                    </div>

                </form>
            </div>
        </div>
    </div>



 @endsection

