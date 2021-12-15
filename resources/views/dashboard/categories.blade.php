@extends('layouts.dashboard')
 @section('content')

<div class="content-body">
    <div class="container pd-x-0">
      <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Category List</li>
            </ol>
          </nav>
          <h4 class="mg-b-0 tx-spacing--1">Category List</h4>
        </div>
      </div>

      <div class="row row-xs">
        <div class="col-12 justify-content-center text-center align-items-center">
          <a href="#addService" class="btn btn-primary float-right" data-toggle="modal"><i class="fas fa-plus"></i> Add New</a>
        </div>

        <div class="col-lg-12 col-xl-12 mg-t-10">
            <div class="card mg-b-10">
              <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                <div>
                  <h6 class="mg-b-5">This table displays a list of all Small Hurry Categories.</h6>
                  {{-- <p class="tx-13 tx-color-03 mg-b-0">This table displays a list of all Small Hurry Categories.</p> --}}
                </div>

              </div><!-- card-header -->

              <div class="table-responsive">
                <div id="sort_table">
                  {{-- @include('admin.category._table') --}}
      {{---#### Category table  #####----}}

    <table class="table table-hover mg-b-0" id="">
    <thead class="thead-primary">
      <tr>
        <th class="text-center">s/n</th>
        <th>Category Name</th>
        <th>Created By</th>
        {{-- <th class="text-center">Labour Markup (%)</th>
        <th class="text-center">Materials Markup (%)</th>
        <th class="text-center">Services</th>
        <th>Status</th> --}}
        <th>Date Created</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      {{-- @foreach ($categories as $category ) --}}
        <tr>
          <td class="tx-color-03 tx-center">1</td>
          <td class="tx-medium">Electronics</td>
          <td>Kenneth (Admin)</td>
          <td class="tx-medium text-center">26-11-2021</td>
          {{-- <td class="tx-medium text-center">mnv</td>
          <td class="tx-medium text-center">suss</td> --}}
          {{-- @if(empty($category->deleted_at))  --}}
          {{-- <td class="text-success">Active</td> --}}
          {{-- @else  --}}
            {{-- <td class="text-danger">Inactive</td> --}}
          {{-- @endif --}}

          <td class=" text-center">
            {{-- @if(!empty($category->name)) --}}
              <div class="dropdown-file">
                <a href="" class="dropdown-link" data-toggle="dropdown"><i data-feather="more-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right">

                {{-- @if($category->id > '1') --}}
                  {{-- <a href="#serviceDetails" data-toggle="modal" class="dropdown-item details text-primary" title="View details" data-url="" data-service-name="" id="service-details"><i class="far fa-clipboard"></i> Details</a> --}}

                  <a href="#editService" data-toggle="modal" id="service-edit" title="Edit {{ '$category->name' }}" data-url="" data-service-name="{{ '$category->name' }}" data-labour-markup="{{ '$category->labour_markup' }}" data-material-markup="{{ '$category->material_markup' }}" data-id="{{ '$category->uuid' }}" class="dropdown-item details text-info"><i class="far fa-edit"></i> Edit</a>

                  {{-- @if(empty($category->deleted_at))  --}}
                    {{-- <a data-url="" class="dropdown-item details text-warning deactivate-entity" title="Deactivate {{ '$category->name'}}" style="cursor: pointer;"><i class="fas fa-ban"></i> Deactivate</a> --}}
                  {{-- @else --}}
                    {{-- <a href="" class="dropdown-item details text-success" title="Reinstate {{ '$category->name'}}"><i class="fas fa-undo"></i> Reinstate</a> --}}
                  {{-- @endif --}}

                  {{-- @if(Auth::id() == 1) --}}
                  {{-- <a href="#serviceReassign" data-toggle="modal" class="dropdown-item details text-secondary" id="service-reassign" data-url="" data-service-name="{{ '$category->name'}}" title="Reassign {{ '$category->name'}} categories"><i class="fas fa-arrows-alt"></i> Reassign</a> --}}
                  {{-- @endif --}}
                  <a data-url="" class="dropdown-item delete-entity text-danger" title="Delete {{ '$category->name'}}" style="cursor: pointer;"><i class="fas fa-trash"></i> Delete</a>

                {{-- @else --}}

                  {{-- <a href="#serviceReassign" data-toggle="modal" class="dropdown-item details text-primary" id="service-reassign" data-url="" data-service-name="{{ '$category->name'}}" title="View {{ '$category->name'}} categories"><i class="fas fa-clipboard"></i> Details</a> --}}

                {{-- @endif --}}
                </div>
              </div>
            {{-- @endif --}}
          </td>
        </tr>
      {{-- @endforeach --}}
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
        <form method="POST" action="">
          @csrf
          <h5 class="mg-b-2"><strong>Create New Category</strong></h5>
          <div class="form-row mt-4">
            <div class="form-group col-md-12">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name') }}" autocomplete="off" required>
                {{-- @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror --}}
            </div>
            {{-- <div class="form-group col-md-12">
              <label for="labour_markup">Labour Markup</label>
              <input type="number" class="form-control @error('labour_markup') is-invalid @enderror" id="labour_markup" name="labour_markup" placeholder="Labour Markup" value="{{ old('labour_markup') }}" autocomplete="off" required>
              @error('labour_markup')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div> --}}
            {{-- <div class="form-group col-md-12">
              <label for="material_markup">Material Markup</label>
              <input type="number" class="form-control @error('material_markup') is-invalid @enderror" id="material_markup" name="material_markup" placeholder="Material Markup" value="{{ old('material_markup') }}" autocomplete="off" required>
              @error('material_markup')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div> --}}
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
      <div class="modal-footer"></div>
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
