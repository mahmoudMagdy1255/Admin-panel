<!DOCTYPE html>
<html dir="{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ app_name() }} | {{$title}} </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    @include('adminpanel::includes.css')
    <!-- Google Font -->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('adminpanel::includes.header')

    <!-- Left side column. contains the logo and sidebar -->
    @include('adminpanel::includes.aside')
    <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
        <!-- /.content -->
        </div>
    <!-- /.content-wrapper -->
    @include('adminpanel::includes.footer')


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
    @include('adminpanel::includes.js')

    @include('adminpanel::includes.messages')

</body>
</html>
