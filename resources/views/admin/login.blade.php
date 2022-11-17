<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fashion Admin - Dotlogics | Login</title>
    <!-- <link rel="icon" href="{{asset('backend/img/logo.png')}}" type="image/png"> -->
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap1.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/themefy_icon/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/swiper_slider/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/niceselect/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/owl_carousel/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/gijgo/gijgo.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/font_awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/tagsinput/tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/datatable/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/datatable/css/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/datatable/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/text_editor/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/morris/morris.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/material_icon/material-icons.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/style1.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/colors/default.css" id="colorSkinCSS')}}">
</head>

<body class="crm_body_bg">

    <!-- main content section start -->
    <div class="main_content_iner ">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_box mb_30">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                            @if (Session::has('password_check'))
                                <div class="container-fluid hidediv">
                                    <div class="card card-style">
                                        <div class="card-body">
                                            <div class="alert alert-danger">{{ session::get('password_check') }}</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="modal-content cs_modal">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Log in</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('login_user')}}" method="POST">
                                            @csrf
                                            <div class="">
                                                <input type="email" name="email" class="form-control" placeholder="Enter your email">
                                            </div>
                                            <div class="">
                                                <input type="password" name="password" class="form-control" placeholder="Password">
                                            </div>
                                            <button class="btn_1 full_width text-center">Log in</button>
                                            <p>Need an account? <a data-bs-toggle="modal" data-bs-target="#sing_up" data-bs-dismiss="modal" href="{{url('signup')}}"> Sign Up</a></p>
                                            <div class="text-center">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#forgot_password" data-bs-dismiss="modal" class="pass_forget_btn">Forget Password?</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main content section end -->


    <script src="{{asset('backend/js/jquery1-3.4.1.min.js')}}"></script>
    <script src="{{asset('backend/js/popper1.min.js')}}"></script>
    <script src="{{asset('backend/js/bootstrap1.min.js')}}"></script>
    <script src="{{asset('backend/js/metisMenu.js')}}"></script>
    <script src="{{asset('backend/vendors/count_up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('backend/vendors/chartlist/Chart.min.js')}}"></script>
    <script src="{{asset('backend/vendors/count_up/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('backend/vendors/swiper_slider/js/swiper.min.js')}}"></script>
    <script src="{{asset('backend/vendors/niceselect/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('backend/vendors/owl_carousel/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('backend/vendors/gijgo/gijgo.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatable/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatable/js/jszip.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{asset('backend/vendors/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('backend/js/chart.min.js')}}"></script>
    <script src="{{asset('backend/vendors/progressbar/jquery.barfiller.js')}}"></script>
    <script src="{{asset('backend/vendors/tagsinput/tagsinput.js')}}"></script>
    <script src="{{asset('backend/vendors/text_editor/summernote-bs4.js')}}"></script>
    <script src="{{asset('backend/vendors/apex_chart/apexcharts.js')}}"></script>
    <script src="{{asset('backend/js/custom.js')}}"></script>
    <script src="{{asset('backend/js/active_chart.js')}}"></script>
    <script src="{{asset('backend/vendors/apex_chart/radial_active.js')}}"></script>
    <script src="{{asset('backend/vendors/apex_chart/stackbar.js')}}"></script>
    <script src="{{asset('backend/vendors/apex_chart/area_chart.js')}}"></script>
    <script src="{{asset('backend/vendors/apex_chart/bar_active_1.js')}}"></script>
    <script src="{{asset('backend/vendors/chartjs/chartjs_active.js')}}"></script>

</body>

</html>