@extends('layouts.dashboard')
@section('content')


<div class="content-body">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item activePage" aria-current="page">Update Profie</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0 tx-spacing--1">Update Profile</h4>
            </div>
        </div>

        <!-- <div class="row row-xs">
            <div class="col-lg-12 col-xl-12">
                <form method="POST" action="{{route('update_user')}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="" name="first_name" value="{{$user->first_name}}">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="first_name">Middle Name</label>
                                <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="" name="middle_name" value="{{$user->middle_name}}">
                                @error('middle_name')
                                <span class=" invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="first_name">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="" name="last_name" value="{{$user->last_name}}">
                                @error('last_name')
                                <span class=" invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="" name="email" value="{{$user->email}}" readonly>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="first_name">Phone Number</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="" name="phone" value="{{$user->phone}}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div> -->


        <div class="row row-xs">
            <div class="col-lg-12 col-xl-12">
                <div class="card">

                    <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent3">
                        <div class="tab-pane fade show active" id="description3" role="tabpanel" aria-labelledby="description-tab3">
                            <div class="card-body pd-20 pd-lg-25">
                                <form action="{{route('update_user')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="d-sm-flex float-left">

                                        <div class="mg-sm-r-30">
                                            <div class="pos-relative d-inline-block mg-b-20">
                                                <a href="#">

                                                    <div class="avatar avatar-xxl">
                                                        <div class="user-img">
                                                            <img class="rounded-circle" src="{{$user->image_url == 'default-user.png'? asset('assets/images/users/'.$user->image_url): $user->image_url}}" alt="user-image">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div><!-- col -->
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">First Name</label>
                                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{$user->first_name}}">
                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Middle Name</label>
                                            <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name" value="{{$user->middle_name}}">
                                            @error('middle_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <!-- Last Name -->
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Last Name</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{$user->last_name}}">
                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        {{-- gender --}}

                                        <!-- Email -->
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{$user->email}}" readonly>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <!-- Phone Number -->
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Phone Number</label>
                                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="" name="phone" maxlength="11" value="{{$user->phone}}">
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <!-- Profile Avatar -->
                                        <div class="form-group col-md-4">
                                            <label>Profile Image</label>
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" class="custom-file-input @error('image') is-invalid @enderror" name="image">
                                                <label class="custom-file-label" id="imagelabel" for="profile_image">Upload Profile Image</label>
                                                @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </form>
                            </div>
                        </div>

                    </div>

                    @endsection