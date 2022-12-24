@extends('admin.layouts.master')
@section('title', 'Category List')
@section('content')
<style>
    .edit_icon {
        font-size: 23px;
        border: 1px solid black;
        border-radius: 6px;
        padding: 6px;
    }
</style>
<div id="message_div" style="width: 400px; margin-left: 29px;"></div>
<div class="main_content_iner ">
    <div class="container-fluid plr_30 body_white_bg pt_30">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h4>Table</h4>
                        <div class="box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form Active="#">
                                        <div class="search_field">
                                            <input type="text" placeholder="Search content here...">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                                <a href="{{url('category/add_category')}}" class="btn_1">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="QA_table ">
                        <table class="table lms_table_active mb-10">
                            <thead>
                                <tr>
                                    <th scope="col">S.No.</th>
                                    <th scope="col">Coupon Title</th>
                                    <th scope="col">Coupon Code</th>
                                    <th scope="col">Start On</th>
                                    <th scope="col">Expire On</th>
                                    <th scope="col">Amount or Percentage</th>
                                    <th scope="col">Current Status</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($coupons)
                                @php
                                $i = 1;
                                @endphp
                                @foreach($coupons as $data)
                                @php
                                $status = '';
                                if ($data) {
                                if ($data->status == 'active') {
                                $status = "Active";
                                $class = "btn btn-outline-success";
                                } elseif($data->status == 'expired'){
                                $status = "Expired";
                                $class = "btn btn-outline-danger";
                                }
                                else {
                                $status = "Inactive";
                                $class = "btn btn-outline-danger";
                                }
                                }
                                @endphp
                                <tr id="coupon_row_{{$data->id}}">
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$data->coupon_title}}</td>
                                    <td>{{$data->coupon_code}}</td>
                                    <td>{{$data->start_date}}</td>
                                    <td>{{$data->end_date}}</td>
                                    <td>{{$data->amount_percentage}}</td>
                                    <td>
                                        <div id="status_button_div_{{$data->id}}">
                                            <button type="button" id="status_button_{{$data->id}}" class="{{$class}}">{{$status}}</button>
                                        </div>
                                        <div class="spinner-border text-secondary" id="status_btn_ldng_{{$data->id}}" style="display: none;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div id="drop_status_hide{{$data->id}}">
                                            <select name="" id="status_dropdown" class="form-select" onchange="status_dropdown({{$data->id}});">
                                                <option value="active" {{$data->status == 'active' ? 'selected' : ''}}>Active</option>
                                                <option value="inactive" {{$data->status == 'inactive' ? 'selected' : ''}}>In Active</option>
                                                <option value="expired" {{$data->status == 'expired' ? 'selected' : ''}}>Expired</option>
                                            </select>
                                        </div>
                                        <div class="spinner-grow spinner-grow-sm" id="loading_btn_{{$data->id}}" style="display: none;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{url('coupon/edit_coupon')}}/{{$data->id}}"><i class="ti-pencil edit_icon"></i></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <i class="ti-trash edit_icon" onclick="delete_coupon({{$data->id}})"></i>
                                        <div class="spinner-border spinner-border-sm" id="delete_loading_{{$data->id}}" style="display: none;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function status_dropdown(id) {
        status_value = document.getElementById("status_dropdown").value;
        coupon_id = id;

        document.getElementById('status_dropdown').onchange = function() {
            alert(this.value);
        }

        // alert(option.value);
        console.log(status_value);
        console.log(coupon_id);
        return false;
        var status_button = "status_button_" + id;
        var status_button_div = "status_button_div_" + id;
        var loading_btn = "loading_btn_" + id;
        var status_btn_ldng = "status_btn_ldng_" + id;
        var drop_status_hide = "drop_status_hide" + id;
        
        var msgDiv = '';
        let data = {
            _token: '{{ csrf_token() }}',
            _method: 'POST',
            status: status_value,
            coupon_id: coupon_id,
        }

        document.getElementById(status_button).style.display = "none";
        document.getElementById(loading_btn).style.display = "block";
        document.getElementById(status_btn_ldng).style.display = "block";
        document.getElementById(drop_status_hide).style.display = "none";

        $.ajax({
            type: "POST",
            url: "{{ url('coupon/update_status') }}",
            data: data,
            success: function(result) {
                console.log(result);
                if (result.status == true) {
                    msgDiv = '<div class="alert alert-success" role="alert">' + result.message + '</div>';
                } else {
                    msgDiv = '<div class="alert alert-danger" role="alert">' + result.message + '</div>';
                }

                if (result.status_text == "active") {
                    var btn_class = "btn btn-outline-success text-capitalize";
                } else {
                    var btn_class = "btn btn-outline-danger text-capitalize";
                }

                new_status_btn = '<button type="button" id="status_button_' + id + '" class="' + btn_class + '">' + result.status_text + '</button>';

                document.getElementById("message_div").innerHTML = msgDiv;
                document.getElementById(status_button_div).innerHTML = new_status_btn;
                document.getElementById(loading_btn).style.display = "none";
                document.getElementById(status_btn_ldng).style.display = "none";
                document.getElementById(drop_status_hide).style.display = "block";

                setTimeout(function() {
                    $('.alert').fadeOut('slow');
                }, 1500);
            }
        });
    }

    function changeStatus(id) {
        var msgDiv = '';
        var status_button = "status_button_" + id;
        var status_button_div = "status_button_div_" + id;
        var loading_btn = "loading_btn_" + id;
        let data = {
            _token: '{{ csrf_token() }}',
            _method: 'POST',
            cat_id: id,
        }

        document.getElementById(status_button).style.display = "none";
        document.getElementById(loading_btn).style.display = "block";

        $.ajax({
            type: "POST",
            url: "{{ url('category/update_status') }}",
            data: data,
            success: function(result) {
                if (result.status == true) {
                    msgDiv = '<div class="alert alert-success" role="alert">' + result.message + '</div>';
                } else {
                    msgDiv = '<div class="alert alert-danger" role="alert">' + result.message + '</div>';
                }

                if (result.status_text == "Active") {
                    var btn_class = "btn btn-outline-success";
                } else {
                    var btn_class = "btn btn-outline-danger";
                }

                new_status_btn = '<button type="button" id="status_button_' + id + '" class="' + btn_class + '" onclick="changeStatus(' + id + ');">' + result.status_text + '</button>';

                document.getElementById("message_div").innerHTML = msgDiv;
                document.getElementById(status_button_div).innerHTML = new_status_btn;
                document.getElementById(loading_btn).style.display = "none";

                setTimeout(function() {
                    $('.alert').fadeOut('slow');
                }, 1500);
            }
        });
    }

    function delete_coupon(id) {
        var delete_loading = "delete_loading_" + id;
        var coupon_row = "coupon_row_" + id;
        document.getElementById(delete_loading).style.display = "block";

        let data = {
            _token: '{{ csrf_token() }}',
            _method: 'POST',
            coupon_id: id,
        }

        $.ajax({
            type: "POST",
            url: "{{ url('coupon/delete_coupon') }}",
            data: data,
            success: function(result) {
                if (result.status == true) {
                    msgDiv = '<div class="alert alert-success" role="alert">' + result.message + '</div>';
                } else {
                    msgDiv = '<div class="alert alert-danger" role="alert">' + result.message + '</div>';
                }

                document.getElementById(delete_loading).style.display = "none";
                document.getElementById("message_div").innerHTML = msgDiv;
                document.getElementById(coupon_row).remove();

                setTimeout(function() {
                    $('.alert').fadeOut('slow');
                }, 1500);
            }
        });
    }
</script>
@endsection