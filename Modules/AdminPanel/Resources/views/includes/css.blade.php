
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{admin_design('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{admin_design('bower_components/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{admin_design('bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{admin_design('dist/css/AdminLTE.min.css')}}">
<!-- AdminLTE Skins. Choose a skin from the css/skins
 folder instead of downloading all of them to reduce the load. -->

 @if(App()->getLocale() == 'ar')
   <link rel="stylesheet" href="{{ admin_design('bootstrap/css/bootstrap-rtl.min.css') }}">
   <link rel="stylesheet" href="{{ admin_design('dist/css/AdminLTE-rtl.min.css') }}">
   <link rel="stylesheet" href="{{ admin_design('dist/css/skins/_all-skins-rtl.min.css') }}">
 @endif

<link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
<style>
 body {
  font-family: 'Cairo', sans-serif;
 }
</style>

<link rel="stylesheet" href="{{admin_design('dist/css/skins/_all-skins.min.css')}}">
<!-- Morris chart -->
<link rel="stylesheet" href="{{admin_design('bower_components/morris.js/morris.css')}}">
<!-- jvectormap -->
<link rel="stylesheet" href="{{admin_design('bower_components/jvectormap/jquery-jvectormap.css')}}">
<!-- Date Picker -->
<link rel="stylesheet" href="{{admin_design('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{admin_design('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{admin_design('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

 <link rel="stylesheet" href="{{ admin_design('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<link rel="stylesheet" href="{{admin_design('plugins/noty/noty.css')}}">

@stack('css')