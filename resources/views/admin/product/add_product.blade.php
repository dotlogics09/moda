@extends('admin.layouts.master')
@section('title', 'Add Product')
@section('content')
<div class="main_content_iner ">
    <div class="container-fluid plr_30 body_white_bg pt_30">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="box_header ">
                        <div class="main-title">
                            <h3 class="mb-0">Add Product</h3>
                        </div>
                    </div>
                    <form action="{{url('product/store_product')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Product Name</label>
                                <input type="text" class="form-control" name="product_name" id="" placeholder="Enter the Product Name">
                                @if ($errors->has('product_name'))
                                <span class="text-danger errorsignup">{{ $errors->first('product_name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Category</label>
                                <select class="form-select" name="category" id="category_id" onchange="getSubcatDrop();">
                                    <option value="" style="display: none;">Select Category</option>
                                    @foreach($category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                <span class="text-danger errorsignup">{{ $errors->first('category') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Sub Category Name</label>
                                <select class="form-select" name="subcategory" id="subcategory-drop">
                                    <option value="">Select Sub Category</option>
                                </select>
                                @if ($errors->has('subcategory'))
                                <span class="text-danger errorsignup">{{ $errors->first('subcategory') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Price</label>
                                <input type="text" class="form-control" name="price" id="" placeholder="Enter the Price">
                                @if ($errors->has('price'))
                                <span class="text-danger errorsignup">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Discount</label>
                                <input type="text" class="form-control" name="discount" id="" placeholder="Enter the Discount">
                                @if ($errors->has('discount'))
                                <span class="text-danger errorsignup">{{ $errors->first('discount') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Discount Type</label>
                                <select class="form-select" name="discount_type">
                                    <option value="" style="display: none;">Select Discount Type</option>
                                    <option value="percentage">Percentage</option>
                                    <option value="amount">Amount</option>
                                </select>
                                @if ($errors->has('discount_type'))
                                <span class="text-danger errorsignup">{{ $errors->first('discount_type') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Product Image</label>
                                <input type="file" class="form-control" name="product_image" id="inputGroupFile02">
                                <!-- <label class="input-group-text" for="inputGroupFile02">Upload</label> -->
                                @if ($errors->has('product_image'))
                                <span class="text-danger errorsignup">{{ $errors->first('product_image') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Product Description</label>
                                <input type="text" class="form-control" name="product_description" id="inputGroupFile02">

                                @if ($errors->has('product_description'))
                                <span class="text-danger errorsignup">{{ $errors->first('product_description') }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function getSubcatDrop(){
        cat_id = document.getElementById("category_id").value;
        let data = {
            _token: '{{ csrf_token() }}',
            _method: 'POST',
            category_id: cat_id,
        }
        
        $.ajax({
            type: "POST",
            url: "{{ url('product/get_subcategory') }}",
            data: data,
            success: function(result) {
                console.log(result);
                
                if(result.status){
                    document.getElementById("subcategory-drop").innerHTML = result.data;
                }else{
                    drop = '<option value="0">'+ result.msg +'</option>';
                    document.getElementById("subcategory-drop").innerHTML = drop;
                }
            }
        });
    }
</script>
@endsection