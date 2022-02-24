@extends('layouts.dashboard')
@section('content')

<div class="content-body">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item activePage" aria-current="page">Edit Store</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0 tx-spacing--1">Edit Store</h4>
            </div>
        </div>
        <div class="row row-xs">
            <div class="col-lg-12 col-xl-12">
                <form method="POST" action="{{route('update_store',$warehouse->id)}}">
                    @csrf
                    @method('PATCH')
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="first_name">Store Name</label>
                                <input type="text" class="form-control @error('store_name') is-invalid @enderror" id="store_name" name="store_name" value="{{ $warehouse->name }}" autocomplete="off">
                                @error('store_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="middle_name">Assign Manager</label>
                                <select class="form-control form-control @error('manager') is-invalid @enderror" name="manager" autocomplete="off">
                                    <option value="{{$warehouse->user_id==0?'':$warehouse->user->id}}">{{$warehouse->user_id==0?'':$warehouse->user->first_name.' '.$warehouse->user->first_name}}</option>
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->first_name.' '.$user->last_name}}</option>
                                    @endforeach
                                </select>
                                @error('manager')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="middle_name">State</label>
                                <select class="form-control" id="state" name="state" autocomplete="off">
                                    <option value="{{$warehouse->state->id}}">{{$warehouse->state->name}}</option>
                                    @foreach($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="middle_name">LGA</label>
                                <select class="form-control" id="lga" name="lga" autocomplete="off" placeholder="">
                                    <option value="{{$warehouse->lga->id}}">{{$warehouse->lga->name}}
                                    <option value=''>Select LGA</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="street">Street</label>
                                <input type="text" class="form-control @error('street') is-invalid @enderror" id="street" name="street" value="{{ $warehouse->street }}" autocomplete="off">
                                @error('street')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="Zip">Email Address</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{$warehouse->email}}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {{--<div class="form-group col-md-3">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude">
                                @error('longitude')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group col-md-3">
                            <label for="first_name">Latitude</label>
                            <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="{{ old('latitude') }}" autocomplete="off">
                            @error('latitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>--}}
                    </div>

            </div>

            <div class="col-md-12 mt-4">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {

        $('#state').on('change', function() {
            let state_id = $(this).val();
            axios.get('{{ url("get_state_lgas") }}/' + state_id)
                .then(response => {
                    let lga_data = response.data;
                    //console.log(me);
                    $("#lga").html(lga_data);
                });

        });

    });

    //});
</script>

@endsection