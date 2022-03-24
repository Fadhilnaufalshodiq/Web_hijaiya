

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.1
    </div>
    <strong>Copyright &copy; <a href=""> .::  © M.Pras  2019 ::.</a>.</strong> All rights
    reserved.
  </footer>

 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<script>
  $(function () {
    $("#mytable").DataTable();
    $('#mytableb').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
    //Initialize Select2 Elements
    $(".select2").select2();
	 //Date picker
    $('.date-picker').datepicker({
		 autoclose: true,
	   format: "dd-mm-yyyy",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
    });

  });
</script>
