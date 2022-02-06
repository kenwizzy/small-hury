@extends('layouts.dashboard')
@section('content')

<div class="content-body">
  <div class="container pd-x-0">
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
      <div>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
            <li class="breadcrumb-item activePage" aria-current="page">Category List</li>
          </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Category List</h4>
      </div>
    </div>

    <div class="row row-xs">
      <div class="col-12 justify-content-center text-center align-items-center">
        <a href="#addService" class="btn btn-primary float-right" data-toggle="modal"><i class="fas fa-plus"></i> Add New</a>
      </div>
      @if (session('success'))
      @section('script')
      <script>
        // Notiflix.Notify.Success('{{ session("success") }}');
        Notiflix.Notify.Success('{{ session("success") }}', {
          timeout: 6000,
        }, );
      </script>
      @endsection
      @endif
      <div class="col-lg-12 col-xl-12 mg-t-10">
        <div class="card mg-b-10">
          <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
            <div>
              <h6 class="tx-13 tx-color-03 mg-b-0">This table displays a list of all Small Hurry Categories.</h6>
            </div>

          </div><!-- card-header -->

          <div class="card-body pd-y-30">
            <div class="d-sm-flex">
              <div class="media">

                <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-teal tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-6">
                  <i data-feather="bar-chart-2"></i>
                </div>
                <div class="media-body">
                  <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">
                    Total categories</h6>
                  <h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">{{$categories->count()}}</h4>
                </div>
              </div>

            </div>
          </div><!-- card-body -->

          <div class="table-responsive">
            <div id="sort_table">

              <table class="table table-hover mg-b-0 basicExample">
                <thead class="thead-primary">
                  <tr>
                    <th class="text-center">s/n</th>
                    <th>Category Name</th>
                    <th>slug</th>
                    <th>Category Image</th>
                    <th>Date Created</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $sn = 1; @endphp
                  @foreach ($categories as $category )
                  <tr>
                    <td class="tx-color-03 tx-center">{{$sn++}}</td>
                    <td class="tx-medium">{{$category->name}}</td>
                    <td>{{$category->slug}}</td>
                    <td>
                      @if($category->cat_img_url == null)
                      UNAVAILABLE
                      @else
                      <img width="100" height="100" src="{{$category->cat_img_url}}">
                      @endif
                    </td>
                    <td class="tx-medium text-center">{{ Carbon\Carbon::parse($category->created_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ssa') }}</td>


                    <td class=" text-center">

                      <div class="dropdown-file">
                        <a href="" class="dropdown-link" data-toggle="dropdown"><i class="fas fa-plus moove"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a href="#editService" data-toggle="modal" id="service-edit" title="Edit {{ $category->name }}" data-url="{{route('dashboard.edit_cat', $category->id)}}" data-service-name="{{ $category->name }}" data-id="{{ '$category->id' }}" class="dropdown-item details text-info"><i class="far fa-edit"></i> Edit</a>

                          <a data-url="" class="dropdown-item delete-entity text-danger" title="Delete {{ '$category->name'}}" style="cursor: pointer;"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
          </div><!-- table-responsive -->
        </div><!-- card -->

      </div><!-- col -->

    </div>

  </div>
</div>

<div class="modal fade" id="addService" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
    <div class="modal-content">
      <div class="modal-body pd-x-25 pd-sm-x-30 pd-t-40 pd-sm-t-20 pd-b-15 pd-sm-b-20">
        <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
        <form method="POST" action="{{route('create_category')}}" enctype="multipart/form-data">
          @csrf

          <h5 class="mg-b-2"><strong>Create New Category</strong></h5><br>

          <div class="form-group col-md-12">
            <label for="name">Category Name</label>
            <input type="text" class="form-control @error(' cat_name') is-invalid @enderror" id="cat_name" name="cat_name" placeholder="Enter Category Name" value="{{ old('name') }}" autocomplete="off" required>
            @error('cat_name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div id="more"></div>

          <div class="form-group col-md-12">
            <button type="button" id="checkMe" class="btn btn-primary btn-sm"><label>Add Sub Category</label></button>
          </div>

          <div class="form-group col-md-12">
            <label for="Cat Img">Category Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" autocomplete="off" required>
            @error('image')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="col-md-12 mt-4">
            <button type="submit" class="btn btn-primary">Create Category</button>
          </div>

        </form>
      </div><!-- modal-body -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal fade" id="serviceDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content tx-14">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel2">Category Details</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pd-x-25 pd-sm-x-30 pd-t-40 pd-sm-t-20 pd-b-15 pd-sm-b-20" id="modal-body">
        <!-- Modal displays here -->
        <div id="spinner-icon"></div>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<div class="modal fade" id="serviceReassign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content tx-14">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel2">Category Details</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pd-x-25 pd-sm-x-30 pd-t-40 pd-sm-t-20 pd-b-15 pd-sm-b-20" id="modal-reassign-body">
        <!-- Modal displays here -->
        <div id="spinner-icon-2"></div>
      </div>
      <div class="modal-footer">Edit Category</div>
    </div>
  </div>
</div>


<div class="modal fade" id="editService" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
    <div class="modal-content">
      <div class="modal-body pd-x-25 pd-sm-x-30 pd-t-40 pd-sm-t-20 pd-b-15 pd-sm-b-20">
        <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>

        <div class="modal-body" id="modal-edit-body">
          <!-- Modal displays here -->
          <div id="spinner-icon-3"></div>
        </div>
      </div><!-- modal-body -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

@endsection

@section('script')
<script>
  $(document).ready(function() {

    let count = 0;
    $("#checkMe").click(function() {

      count++;

      $('#more').append(`
<div class="container_create" id="added${count}">

                    <div class="form-group col-md-12">
                        <label for="name">Sub Category Name</label>
                        <input type="text" class="form-control @error(' sub_cat_name') is-invalid @enderror" id="sub_cat_name" name="sub_cat_name[]" placeholder="Enter Sub Category Name">
                        @error('sub_cat_name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
            <button type="button" id="remove${count}" class="close change" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
`);

    });

    $(document).on("click", ".close", function() {
      var button_id = $(this).attr("id");
      $('#added' + count).remove();
      count--;
    });

  });
</script>

@endsection