<!DOCTYPE html>
<html lang="{{ config('translation.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ $data['_csrf_token'] }}">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- 页面css /-->
        @include('layout.css')
    </head>
    <body class="hold-transition {{config('admin.skin')}} {{ join(' ', config('admin.layout')) }}">
        <div class="wrapper">

            @include('layout.navbar')

            @include('layout.sidebar')

            <div class="content-wrapper" id="pjax-container">
                <div id="app">
                    @yield('content')
                </div>
            </div>

            @include('layout.footer')

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            </aside>

        </div>

        <!-- 页面js /-->
        @include('layout.js')
    </body>
</html>