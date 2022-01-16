@extends('layouts.dashboard')
@section('content')



<div class="content-body">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Attributes</li>
                    </ol>
                </nav>
                <!-- <h4 class="mg-b-0 tx-spacing--1"> All Stores</h4> -->
            </div>
        </div>

        <div class="row row-xs">
            <!-- <div class="col-lg-4 col-xl-4"> -->
            <div class="col-md-4 col-lg-4">
                <form method="POST" action="{{url('add_attribute')}}">
                    @csrf

                    <div class="form-group">
                        <label for="first_name">Attribute</label>
                        <input type="text" class="form-control" id="" name="name" value="" autocomplete="off">

                    </div>
                    <div class="form-group">
                        <label for="middle_name">Attribute Values</label>
                        <input id="email-tags" name="values" class="form-control" />
                    </div>
                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">Add Attribute</button>
                    </div>

                </form>
            </div>


            <div class="col-lg-8 col-xl-8 mg-t-10">
                @if($attributes->count() > 0)
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover mg-b-0" id="basicExample">
                            <thead class="thead-primary">
                                <tr>
                                    <th class="text-center">s/n</th>
                                    <th>Attribute</th>
                                    <th>Value</th>
                                    <th class="text-left">Date Created </th>
                                    <th class=" text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sn = 1; @endphp
                                @foreach ($attributes as $attr)
                                <tr>
                                    <td class="tx-color-03 tx-center">{{$sn++}}</td>
                                    <td class="tx-medium">{{$attr->name}}</td>
                                    <td class="tx-medium">
                                        @foreach($attr->attributeValues as $res)
                                        {{$res->attribute_val_name}},
                                        @endforeach
                                    </td>
                                    <td class="tx-medium">{{ Carbon\Carbon::parse($attr->created_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ssa') }}</td>
                                    <td class=" text-center">
                                        <div class="dropdown-file"> <a href="" class="dropdown-link" data-toggle="dropdown"><i class="fas fa-plus moove"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="" class="dropdown-item details"><i class="far fa-clipboard"></i> Edit </a>
                                                <a href="" class="dropdown-item details"><i class="far fa-clipboard"></i> Delete </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else

                        <h4 class="text-center text-danger">No Record Found</h4>

                        @endif
                    </div><!-- table-responsive -->
                </div><!-- card -->

            </div><!-- col -->
        </div><!-- row -->


    </div><!-- container -->
</div>

@endsection
@section('script')
<script>
    //const isEmail = input => /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(input);

    $('#email-tags').tagEditor({
        placeholder: 'Enter values ...',
        beforeTagSave: (field, editor, tags, tag, val) => {

            // make sure it is a formally valid email
            // if (!isEmail(val)) {
            //     alert(`"${val}" is not a valid email`);
            //     return false;
            // }
        }
    });
</script>
@endsection
