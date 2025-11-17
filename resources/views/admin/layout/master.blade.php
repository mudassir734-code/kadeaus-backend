<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header')
@yield('style')
<style>
    .fl-wrapper{
        z-index: 999999 !important;
    }
    .error{
        color: red;
    }
</style>
<body class="g-sidenav-show  bg-gray-100">
    @include('admin.layout.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('admin.layout.navbar')
        @yield('content')
    </main>

    @include('admin.layout.script')
    @include('admin.layout.toaster')
    @include('admin.layout.alert-script')
    @yield('script')
</body>

</html>