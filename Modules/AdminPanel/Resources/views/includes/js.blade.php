
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->



<!-- jQuery 3 -->
<script src="{{admin_design('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{admin_design('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{admin_design('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{admin_design('bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{admin_design('bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{admin_design('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{admin_design('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{admin_design('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{admin_design('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{admin_design('bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{admin_design('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{admin_design('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{admin_design('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{admin_design('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{admin_design('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{admin_design('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{admin_design('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{admin_design('dist/js/demo.js')}}"></script>

<script src="{{admin_design('plugins/noty/noty.min.js')}}"></script>
<script src="{{admin_design('dist/js/myFunctions.js')}}"></script>


<script src="{{ admin_design('/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ admin_design('/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ admin_design('/bower_components/datatables.net-bs/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ url('/public/vendor/datatables/buttons.server-side.js')}}"></script>


@stack('js')

<script>
    $('.check_all').click(function(){
        $('.check_this').not(this).prop('checked', this.checked);
    });// end of twxr
    $('.delBtn').on('click',function () {
        $('#multipleDelete').modal('show');
        return false;
    });
    $('.del_all').on('click',function () {
        $('#form_data').submit();
    });

</script>