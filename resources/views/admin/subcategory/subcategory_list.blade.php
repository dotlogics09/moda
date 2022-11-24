@extends('admin.layouts.master')
@section('title', 'Sub Category List')
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
                                <a href="{{url('subcategory/add_subcategory')}}" class="btn_1">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="QA_table ">
                        <table class="table lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">S.No.</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">SubCategory Name</th>
                                    <th scope="col">Category Image</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($subcat)
                                @php
                                $i = 1;
                                @endphp
                                @foreach($subcat as $data)
                                @php
                                $status = '';
                                if ($data) {
                                if ($data->status == 1) {
                                $status = "Active";
                                $class = "btn btn-outline-success";
                                } else {
                                $status = "Inactive";
                                $class = "btn btn-outline-danger";
                                }
                                }
                                @endphp
                                <tr id="subcategory_row_{{$data->subcat_id}}">
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$data->category_name}}</td>
                                    <td>{{$data->subcategory_name}}</td>
                                    <td>
                                        <img src="{{asset('backend/uploads/subcategory')}}/{{$data->subcategory_image}}" style="height: 59px; width: 80px;" alt="{{$data->subcategory_image}}">
                                    </td>
                                    <td>
                                        <div id="status_button_div_{{$data->subcat_id}}">
                                            <button type="button" id="status_button_{{$data->subcat_id}}" class="{{$class}}" onclick="changeStatus({{$data->subcat_id}});">{{$status}}</button>
                                        </div>
                                        <button class="btn btn-primary" type="button" id="loading_btn_{{$data->subcat_id}}" disabled="" style="display: none;">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...
                                        </button>
                                    </td>
                                    <td>
                                        <a href="{{url('subcategory/edit_subcategory')}}/{{$data->subcat_id}}"><i class="ti-pencil edit_icon"></i></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <i class="ti-trash edit_icon" onclick="delete_subcat({{$data->subcat_id}})"></i>
                                        <div class="spinner-border spinner-border-sm" id="delete_loading_{{$data->subcat_id}}" style="display: none;" role="status">
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
    function changeStatus(id) {
        var msgDiv = '';
        var status_button = "status_button_" + id;
        var status_button_div = "status_button_div_" + id;
        var loading_btn = "loading_btn_" + id;
        let data = {
            _token: '{{ csrf_token() }}',
            _method: 'POST',
            subcat_id: id,
        }

        document.getElementById(status_button).style.display = "none";
        document.getElementById(loading_btn).style.display = "block";

        $.ajax({
            type: "POST",
            url: "{{ url('subcategory/update_status') }}",
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

    function delete_subcat(id) {
        var delete_loading = "delete_loading_" + id;
        var subcategory_row = "subcategory_row_"+id;
        document.getElementById(delete_loading).style.display = "block";

        let data = {
            _token: '{{ csrf_token() }}',
            _method: 'POST',
            subcategory_id: id,
        }

        $.ajax({
            type: "POST",
            url: "{{ url('subcategory/delete_subcategory') }}",
            data: data,
            success: function(result) {
                console.log(result);
                if (result.status == true) {
                    msgDiv = '<div class="alert alert-success" role="alert">' + result.message + '</div>';
                } else {
                    msgDiv = '<div class="alert alert-danger" role="alert">' + result.message + '</div>';
                }

                document.getElementById(delete_loading).style.display = "none";
                document.getElementById("message_div").innerHTML = msgDiv;
                document.getElementById(subcategory_row).remove();
                
                setTimeout(function() {
                    $('.alert').fadeOut('slow');
                }, 1500);
            }
        });
    }
</script>
@endsection