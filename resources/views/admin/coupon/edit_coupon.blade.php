@extends('admin.layouts.master')
@section('title', 'Edit Coupon')
@section('content')
<div class="main_content_iner ">
    <div class="container-fluid plr_30 body_white_bg pt_30">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="box_header ">
                        <div class="main-title">
                            <h3 class="mb-0">Edit Coupon</h3>
                        </div>
                    </div>
                    <form action="{{url('coupon/update_coupon')}}/{{$coupon_edit->id}}" method="POST">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Coupon Title</label>
                                        <input type="text" class="form-control" name="coupon_title" value="{{$coupon_edit->coupon_title}}" id="" placeholder="Enter the Product Name">
                                        @if ($errors->has('coupon_title'))
                                        <span class="text-danger errorsignup">{{ $errors->first('coupon_title') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Coupon Code</label>
                                        <input type="text" class="form-control" name="coupon_code" value="{{$coupon_edit->coupon_code}}" id="" placeholder="Enter the Product Name">
                                        @if ($errors->has('coupon_code'))
                                        <span class="text-danger errorsignup">{{ $errors->first('coupon_code') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Start Date</label>
                                        <input type="date" class="form-control" name="start_date" value="{{$coupon_edit->start_date}}" id="" placeholder="Enter the Price">
                                        @if ($errors->has('start_date'))
                                        <span class="text-danger errorsignup">{{ $errors->first('start_date') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">End Date</label>
                                        <input type="date" class="form-control" name="end_date" value="{{$coupon_edit->end_date}}" id="" placeholder="Enter the Discount">
                                        @if ($errors->has('end_date'))
                                        <span class="text-danger errorsignup">{{ $errors->first('end_date') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Use Limit</label>
                                        <input type="text" class="form-control" name="use_limit" value="{{$coupon_edit->use_limit}}" id="" placeholder="Enter the Product Name">
                                        @if ($errors->has('use_limit'))
                                        <span class="text-danger errorsignup">{{ $errors->first('use_limit') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Discount Type</label>
                                        <select class="form-select" name="discount_type">
                                            <option value="" style="display: none;">Select Discount Type</option>
                                            <option value="percentage" {{$coupon_edit->discount_type == 'percentage' ? "selected" : ''}}>Percentage</option>
                                            <option value="amount" {{$coupon_edit->discount_type == 'amount' ? "selected" : ''}}>Amount</option>
                                        </select>
                                        @if ($errors->has('discount_type'))
                                        <span class="text-danger errorsignup">{{ $errors->first('discount_type') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Amount / Percentage</label>
                                        <input type="text" class="form-control" name="amount_percentage" value="{{$coupon_edit->amount_percentage}}" id="inputGroupFile02">
                                        @if ($errors->has('amount_percentage'))
                                        <span class="text-danger errorsignup">{{ $errors->first('amount_percentage') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Minimum Purchase Amount</label>
                                        <input type="text" class="form-control" name="min_pur_amt" value="{{$coupon_edit->minimum_purc_amt}}" id="inputGroupFile02">
                                        @if ($errors->has('min_pur_amt'))
                                        <span class="text-danger errorsignup">{{ $errors->first('min_pur_amt') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Days Applied On</label>
                                        <div class="container">
                                            <div class="row">
                                                @foreach($days as $day)
                                                <div class="col-md-2">
                                                    <div class="input-group mb-3">
                                                        <label for="">
                                                            <!-- <div class="input-group-text"> -->
                                                            <input type="checkbox" value="{{$day}}" @if(!is_null($selected_days) && in_array($day, $selected_days)) checked @endif name="days[]" aria-label="Checkbox for following text input">
                                                            <!-- </div> -->
                                                            {{$day}}
                                                        </label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput1">Description</label>
                                        <input type="text" class="form-control" name="description" value="{{$coupon_edit->description}}" id="inputGroupFile02">
                                        @if ($errors->has('description'))
                                        <span class="text-danger errorsignup">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="mb-3">
                                    <input class="btn btn-primary" type="submit" value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection