@extends('layouts.dashboard')
@section('content')

<div class="content-body pd-0">
  <div class="contact-wrapper contact-wrapper-two">
    <div class="contact-content">
      <div class="contact-content-header">
        <nav class="nav">
        </nav>
      </div><!-- contact-content-header -->

      <div class="contact-content-body">
        <div class="tab-content">

          @if (session('success'))
          @section('script')
          <script>
            Notiflix.Notify.Success('{{ session("success") }}', {
              timeout: 4000,
            }, );
          </script>
          @endsection
          @endif

          <div id="contactInformation" class="tab-pane show active pd-20 pd-xl-25">
            <div class="d-flex align-items-center justify-content-between mg-b-25">
              <h5 class="mg-b-0">Personal Details</h5>
              <div class="d-flex">
                <a href="{{route('dashboard.edit_user')}}" class="btn btn-primary float-right"><i class="fas fa-edit"></i>Edit</a>

              </div>
            </div>

            <div class="row">
              <div class="col-6 col-sm">
                <label class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Firstname</label>
                <p class="mg-b-0">{{$user->first_name}}</p>
                </p>
              </div><!-- col -->
              <div class="col-6 col-sm">
                <label class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Middlename</label>
                <p class="mg-b-0">{{$user->middle_name}}</p>
              </div><!-- col -->
              <div class="col-sm mg-t-20 mg-sm-t-0">
                <label class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Lastname</label>
                <p class="mg-b-0">{{$user->last_name}}</p>
              </div><!-- col -->
            </div><!-- row -->

            <h5 class="mg-t-40 mg-b-20">Contact Details</h5>

            <div class="row row-sm">
              <div class="col-6 col-sm-4">
                <label class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Email Address</label>
                <p class="tx-primary mg-b-0">{{$user->email??'Unavailable'}}</p>
              </div>
              <div class="col-6 col-sm-4">
                <label class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Mobile Phone</label>
                <p class="tx-primary tx-rubik mg-b-0">{{$user->phone??'Unavailable'}}</p>
              </div>
              <div class="col-6 col-sm-4">
                <label class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Date Created</label>
                <p class="tx-primary tx-rubik mg-b-0">{{ Carbon\Carbon::parse($user->created_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ssa') }}</p>
              </div>

            </div><!-- row -->


          </div><!-- row -->
        </div>
      </div><!-- tab-content -->
    </div><!-- contact-content-body -->

  </div><!-- contact-content -->

</div><!-- contact-wrapper -->
</div>

@endsection