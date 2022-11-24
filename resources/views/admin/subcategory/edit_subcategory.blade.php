@extends('admin.layouts.master')
@section('title', 'Add Sub Category')
@section('content')
<div class="main_content_iner ">
    <div class="container-fluid plr_30 body_white_bg pt_30">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="box_header ">
                        <div class="main-title">
                            <h3 class="mb-0">Edit Sub Category</h3>
                        </div>
                    </div>
                    <form action="{{url('subcategory/update_subcategory')}}/{{$edit_data->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Category</label>
                                <select class="form-select" name="category">
                                    <option value="" style="display: none;">Select Category</option>
                                    @foreach($category as $cat)
                                        <option value="{{$cat->id}}" {{$cat->id == $edit_data->category_id ? 'selected' : ''}}>{{$cat->category_name}}</option>
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
                                <input type="text" class="form-control" name="subcategory_name" value="{{$edit_data->subcategory_name}}" id="exampleFormControlInput1" placeholder="Enter the Category Name">
                                @if ($errors->has('subcategory_name'))
                                <span class="text-danger errorsignup">{{ $errors->first('subcategory_name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Sub Category Image</label>
                                <input type="file" class="form-control" name="subcategory_image" value="{{$edit_data->subcategory_image}}" id="inputGroupFile02">
                                <!-- <label class="input-group-text" for="inputGroupFile02">Upload</label> -->
                                @if ($errors->has('subcategory_image'))
                                <span class="text-danger errorsignup">{{ $errors->first('subcategory_image') }}</span>
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
@endsection