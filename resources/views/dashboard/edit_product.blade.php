@extends('layouts.dashboard')
@section('content')


<div class="content-body">
    <div class="container pd-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                        <li class="breadcrumb-item activePage" aria-current="page">Update Product</li>
                    </ol>
                </nav>
                <h4 class="mg-b-0 tx-spacing--1">Update Product</h4>
            </div>

            @if (session('success'))
            @section('script')
            <script>
                Notiflix.Notify.Success('{{ session("success") }}', {
                    timeout: 4000,
                }, );
            </script>
            @endsection
            @endif
        </div>
        <div class="row row-xs">
            <div class="col-lg-12 col-xl-12">
                <form method="POST" action="{{route('create_product')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" value="{{$product->name}}" name="product_name">
                                @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="real_price">Internal Reference Number</label>
                                <input type="text" class="form-control @error('int_ref') is-invalid @enderror" id="int_ref" value="{{$product->internal_ref}}" name="int_ref">
                                @error('int_ref')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="last_name">Original Price</label>
                                <input type="number" class="form-control @error('original_price') is-invalid @enderror" id="original_price" value="{{$product->original_price}}" name="original_price">
                                @error('original_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="real_price">Real Price</label>
                                <input type="number" class="form-control @error('real_price') is-invalid @enderror" id="real_price" value="{{$product->real_price}}" name="real_price" readonly>
                                @error('real_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="on_sale">Apply Discount</label>
                                <select class="custom-select @error('discount') is-invalid @enderror" id="disc">
                                    <option>Select Option</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="on_sale">Select Discount</label>
                                <select class="custom-select @error('discount') is-invalid @enderror" id="discount">
                                    <option>Select Discount</option>
                                    @foreach ($discounts as $dis)
                                    <option value="{{$dis->value}}"> {{$dis->value}}%</option>
                                    @endforeach
                                </select>
                                @error('discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="on_sale">Warehouse</label>
                                <select class="custom-select @error('store') is-invalid @enderror" id="store" name="store">
                                    {{--<option>Select Warehouse</option>--}}
                                    {{--<option value="{{$warehouses->id}}">{{$warehouses->name}}</option>--}}
                                    {{--@if($warehouses->count() > 0)--}}
                                    {{--<option value="">All Warehouses</option>--}}
                                    @if(Auth::user()->role->name == 'Warehouse Manager')

                                    <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>

                                    @else
                                    <option value="all">All Warehouses</option>
                                    @foreach ($warehouses as $store)
                                    <option value="{{$store->id}}">{{$store->name}}</option>
                                    @endforeach
                                    @endif

                                </select>
                                @error('store')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">Default Image</label><br>
                                <img src="{{$product->DefaultImage->image_url}}" width="100"><br>
                                <input type="file" class="form-control @error('default_image') is-invalid @enderror" id="default_image" name="default_image">
                                @error('default_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="phone_number">Quantity</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" value="{{Auth::user()->role->name == 'Warehouse Manager'? $product->productStoreQty()->total_quantity : $product->totalItems()}}" name="quantity">
                                @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="middle_name">Select Category</label>
                                <select class="form-control" id="cat_id" name="product_category" autocomplete="off">
                                    <option value="{{$product->category->id}}">{{Str::title($product->category->name)}}</option>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $cat)
                                    <option value="{{$cat->id}}">{{Str::title($cat->name)}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="middle_name">Select Sub Category</label>
                                <select class="form-control" id="subcat_id" name="sub_category">
                                    <option value="{{$product->subCat->id}}">{{$product->subCat->name}}</option>
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>

                        </div>

                        @foreach($product->attrs() as $opt)
                        <div class="form-row default">
                            <div class="form-group col-md-4">
                                <label for="on_sale">Attribute</label>
                                <select class="custom-select @error('attr_id') is-invalid @enderror" id="attr_id" name="attribute[]">
                                    <option value="">{{$opt->name}}</option>
                                    <option>Select</option>
                                    @foreach($attributes as $attribute)
                                    <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                                    @endforeach
                                </select>
                                @error('attribute')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="password">Attribute Values</label>
                                <select class="form-control @error('attribute_value') is-invalid @enderror" id="attr_val" name="attribute_value[]">
                                    <option value="">{{$opt->attribute_val_name}}</option>
                                    <option value=''>Select Values</option>
                                </select>
                                @error('attribute_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Attribute Image</label><br>
                                <img src="{{$opt->image_url}}" width="100"><br>
                                <input type="file" class="form-control @error('attribute_image') is-invalid @enderror" id="default_image" name="attribute_image[]">
                                @error('attribute_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        @endforeach


                        <div id="more"></div><br>
                        <div class="form-group col-md-4">
                            <button type="button" id="checkMe" class="btn btn-primary btn-sm">Add more</button>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12" style="margin:auto;">
                                <label for="confirm_password">Product Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{$product->description}}</textarea>
                                @error('description')
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

    @section('script')
    <script>
        $(document).ready(function() {

            let count = 0;

            assignName(count);

            function assignName(count) {

                $(document).on("change", ".do", function() {
                    let attr = $(this).val();
                    axios.get('{{url("get_attr_values")}}/' + attr)
                        .then(response => {
                            let attr_values = response.data;
                            //console.log(attr_values);
                            $("#attr_value" + count).html(attr_values);
                        });
                    count++;
                });

            }
            $('#disc').on('change', function() {
                var disc = $(this).val();
                if (disc == 0) {
                    $('#discount').attr('disabled', true);
                    var originalPrice = $('#original_price').val();
                    $('#real_price').val(originalPrice);

                } else {
                    $('#discount').attr('disabled', false);
                }
            });

            $('#discount').on('change', function() {
                var percentageDiscount = $(this).val() / 100;
                $('#real_price').val($('#original_price').val() * (1 - percentageDiscount));
            });

            //####### FOR DEFAULT ATTRIBUTE #######
            $('#attr_id').on('change', function() {
                let attr_id = $(this).val();
                axios.get('{{url("get_attr_values")}}/' + attr_id)
                    .then(response => {
                        let attr_values_data = response.data;
                        console.log(attr_values_data);
                        $("#attr_val").html(attr_values_data);
                    });
            });

            //####### FOR CATEGORY & SUB CATEGORY #######
            $('#cat_id').on('change', function() {
                let cat_id = $(this).val();
                axios.get('{{url("get_subcategory_values")}}/' + cat_id)
                    .then(response => {
                        let sub_category_data = response.data;
                        if (sub_category_data == '') {
                            $('#subcat_id').attr('readonly', true);
                            $("#subcat_id").html('');
                        } else {
                            $('#subcat_id').attr('readonly', false);
                            $("#subcat_id").html(sub_category_data);
                        }
                    });
            });

            $("#checkMe").click(function() {

                count++;

                $('#more').append(`
                <div class="container_create" id="added${count}">
                      <div class="container_fields">
                                <div class="fields">
                                    <label for="on_sale">Attribute</label>
                                    <select class="form-control do @error('attribute') is-invalid @enderror" id="attribute${count}" name="attribute[]">
                                        <option>Select</option>
                                        {{--@foreach($attributes as $attribute)
                                        <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                                        @endforeach--}}
                                    </select>
                                    @error('attribute')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="fields">
                                    <label for="password">Attribute Values</label>
                                    <select class="form-control @error('attribute_value') is-invalid @enderror" id="attr_value${count}" name="attribute_value[]">
                                        <option>Select Values</option>
                                    </select>
                                    @error('attribute_value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="fields">
                                    <label for="inputEmail4">Attribute Image</label>
                                    <input type="file" class="form-control @error('attribute_image') is-invalid @enderror" id="attr_image" name="attribute_image[]">
                                    @error('attribute_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
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