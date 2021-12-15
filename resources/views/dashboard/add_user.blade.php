@extends('layouts.dashboard')
 @section('content')


<div class="content-body">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add User</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0 tx-spacing--1">Create New User</h4>
            </div>
        </div>

        <div class="row row-xs">
            <div class="col-lg-12 col-xl-12">
                <form method="POST" action="">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="" autocomplete="off">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="first_name">Middle Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="" autocomplete="off">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="first_name">Last Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="" autocomplete="off">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- <div class="form-group col-md-4">
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
                            </div> --}}

                        </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="first_name">Email Address</label>
                                <input type="email" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="" autocomplete="off">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="first_name">Phone Number</label>
                                <input type="number" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="" autocomplete="off">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="middle_name">User Role</label>
                                <select class="form-control" name="middle_name" autocomplete="off" placeholder="">
                                   <option>Select Role</option>
                                   <option>Admin</option>
                                   <option>Store Manager</option>
                                   <option>Biker</option>
                                </select>
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

