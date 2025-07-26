<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('Dashboard') }}/bootstrap/js/bootstrap.min.js"></script>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>  -->


<!-- <script src="{{ asset('js/jquery-ui.min.js') }}"></script> -->
<script src="{{ asset('js/moment.min.js') }}"></script>

<!-- end -->

<!-- SlimScroll -->
<script src="{{ asset('Dashboard') }}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('Dashboard') }}/plugins/fastclick/fastclick.js"></script>
<!-- Select2 -->
<script src="{{ asset('Dashboard') }}/plugins/select2/select2.full.min.js"></script>

<!-- include summernote js -->
<!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> -->
<script src="{{ asset('js') }}/summernote.min.js"></script>

<!-- Color Picker -->
<script src="{{ asset('Dashboard') }}/dist/js/bootstrap-colorpicker.min.js"></script>

<!-- AdminLTE App -->
<script>
  var AdminLTEOptions = {
    /*https://adminlte.io/themes/AdminLTE/documentation/index.html*/
    sidebarExpandOnHover: true,
    navbarMenuHeight: "200px", //The height of the inner menu
    animationSpeed: 250,
  };
</script>
<script src="{{ asset('Dashboard') }}/dist/js/app.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('Dashboard') }}/dist/js/demo.js"></script>
<!-- page script -->
<!--Toastr notification -->
<script src="{{ asset('Dashboard') }}/toastr/toastr.js"></script>

<!--Toastr notification end-->

<!-- Custom JS -->
<script src="{{ asset('Dashboard') }}/js/special_char_check.js"></script>
<script src="{{ asset('Dashboard') }}/js/custom.js"></script>

<!-- Pace Loader -->
<script src="{{ asset('Dashboard') }}/plugins/pace/pace.min.js"></script>
<script type="text/javascript">
$(document).ajaxStart(function() { Pace.restart(); }); 
</script>  
<!-- Sweet alert -->
<script src="{{ asset('Dashboard') }}/js/sweetalert.min.js"></script>
<!-- iCheck -->
<script src="{{ asset('Dashboard') }}/plugins/iCheck/icheck.min.js"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-orange',
      /*uncheckedClass: 'bg-white',*/
      radioClass: 'iradio_square-orange',
      increaseArea: '10%' // optional
    });
  });
</script>


<!-- Color Picker  -->
<script>
  //Colorpicker
  $(document).ready(function(){
    $('#color_hex').colorpicker();    
  });
</script>


<!-- Initialize Select2 Elements -->
<script type="text/javascript"> $(".select2").select2(); </script>
<!-- Initialize toggler -->
<script type="text/javascript">
  $(document).ready(function(){
      $('[data-toggle="popover"]').popover();   
  });
</script>

<script type="text/javascript">
    $(document).ready(function () { setTimeout(function() {$( ".alert-dismissable" ).fadeOut( 1000, function() {});}, 10000); });
</script>
<script type="text/javascript">
  function round_off(input=0){
          return input;
      }
</script>
<!-- bootstrap datepicker -->

<!-- ChartJS 1.0.1 -->
<script src="{{ asset('Dashboard') }}/plugins/chartjs/Chart.min.js"></script>


<!-- Sparkline -->
<script src="{{ asset('Dashboard') }}/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="{{ asset('Dashboard') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{ asset('Dashboard') }}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

 <!-- BAR CHART -->
<script src="{{ asset('Dashboard') }}/plugins/highcharts/highcharts.js"></script>
<script src="{{ asset('Dashboard') }}/plugins/highcharts/highcharts-more.js"></script>
<script src="{{ asset('Dashboard') }}/plugins/highcharts/exporting.js"></script>
<!-- BAR CHART END -->
<!-- PIE CHART -->
<script src="{{ asset('Dashboard') }}/plugins/highcharts/export-data.js"></script>
<!-- PIE CHART END -->



<!-- validation -->
<script src="{{ asset('js/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/validation/additional-methods.min.js') }}"></script>


<!-- lobilist -->
<!-- custom -->
<!-- <script src="{{ asset('js/custom.js') }}"></script> -->
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/jquery.countTo.js') }}"></script>