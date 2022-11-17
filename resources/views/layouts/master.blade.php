<!DOCTYPE html>
<html lang="zxx">

<head>
    @include('layouts.head')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include('layouts.header')

    @yield('content')
    
    @include('layouts.footer')
</body>

</html>