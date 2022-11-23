@extends('admin.layouts.master')
@section('title', 'Edit Category')
@section('content')
<div class="main_content_iner ">
    <div class="container-fluid plr_30 body_white_bg pt_30">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="box_header ">
                        <div class="main-title">
                            <h3 class="mb-0">Edit Category</h3>
                        </div>
                    </div>
                    <form action="{{url('category/update_category')}}/{{$edit_data->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Category Name</label>
                                <input type="text" class="form-control" name="category_name" value="{{$edit_data->category_name}}" id="exampleFormControlInput1" placeholder="Enter the Category Name">
                                @if ($errors->has('category_name'))
                                <span class="text-danger errorsignup">{{ $errors->first('category_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Category Name</label>
                                <input type="file" class="form-control" name="category_image" value="{{$edit_data->category_image}}" id="inputGroupFile02">
                                <!-- <label class="input-group-text" for="inputGroupFile02">Upload</label> -->
                                @if ($errors->has('category_image'))
                                <span class="text-danger errorsignup">{{ $errors->first('category_image') }}</span>
                                @endif
                            </div>
                        </div>

                        <input class="btn btn-primary" type="submit" value="Update">
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection