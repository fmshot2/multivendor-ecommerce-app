<!doctype html>
<html lang="en">

<head>
    @include('frontend.layouts.head')
</head>

<body>
    @include('frontend.layouts.header')

        @yield('content')

    <!-- Footer Area -->
    @include('frontend.layouts.footer')
    <!-- Footer Area -->

    @include('frontend.layouts.script')

</body>

</html>
