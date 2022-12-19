<nav class="sidebar">
    <div class="logo d-flex justify-content-between">
        <a href="{{url('dashboard')}}"><img src="{{asset('backend/img/logo.png')}}" alt=""></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <!-- <li class="mm-active"> -->
        <li>
            <a href="{{url('dashboard')}}" aria-expanded="false">
                <img src="{{asset('backend/img/menu-icon/1.svg')}}" alt="">
                <span>Dashboard</span>
            </a>
        </li>
        <li class="{{request()->is('category/*') ? 'mm-active' : ''}}">
            <a class="has-arrow" href="#" aria-expanded="false">
                <img src="{{asset('backend/img/menu-icon/2.svg')}}" alt="">
                <span>Category</span>
            </a>
            <ul>
                <li><a href="{{url('category/add_category')}}">Add Category</a></li>
                <li><a href="{{url('category/category_list')}}">Category List</a></li>
            </ul>
        </li>
        <li class="{{request()->is('subcategory/*') ? 'mm-active' : ''}}">
            <a class="has-arrow" href="#" aria-expanded="false">
                <img src="{{asset('backend/img/menu-icon/2.svg')}}" alt="">
                <span>Sub Category</span>
            </a>
            <ul>
                <li><a href="{{url('subcategory/add_subcategory')}}">Add Sub Category</a></li>
                <li><a href="{{url('subcategory/subcategory_list')}}">Sub Category List</a></li>
            </ul>
        </li>
        <li class="{{request()->is('product/*') ? 'mm-active' : ''}}">
            <a class="has-arrow" href="#" aria-expanded="false">
                <img src="{{asset('backend/img/menu-icon/2.svg')}}" alt="">
                <span>Products</span>
            </a>
            <ul>
                <li><a href="{{url('product/add_product')}}">Add Products</a></li>
                <li><a href="{{url('product/product_list')}}">Product List</a></li>
            </ul>
        </li>
        <li class="{{request()->is('coupon/*') ? 'mm-active' : ''}}">
            <a class="has-arrow" href="#" aria-expanded="false">
                <img src="{{asset('backend/img/menu-icon/2.svg')}}" alt="">
                <span>Coupon</span>
            </a>
            <ul>
                <li><a href="{{url('coupon/add_coupon')}}">Add Coupon</a></li>
                <li><a href="{{url('coupon/coupon_list')}}">Coupon List</a></li>
            </ul>
        </li>
        <li class="">
            <a href="{{url('')}}" aria-expanded="false">
                <img src="{{asset('backend/img/menu-icon/2.svg')}}" alt="">
                <span>Invoices</span>
            </a>
        </li>
        <li class="">
            <a class="has-arrow" href="#" aria-expanded="false">
                <img src="{{asset('backend/img/menu-icon/2.svg')}}" alt="">
                <span>Settings</span>
            </a>
            <ul>
                <li><a href="{{url('coupon/add_coupon')}}">Add Coupon</a></li>
                <li><a href="{{url('coupon/coupon_list')}}">Coupon List</a></li>
            </ul>
        </li>
    </ul>
</nav>