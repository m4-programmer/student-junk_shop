<!-- jQuery 3 -->
<script src="../dist/plugins/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../dist/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../dist/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../dist/plugins/select2/dist/js/select2.full.min.js"></script>
<!-- Moment JS -->
<!-- <script src="../dist/plugins/moment/moment.js"></script> -->
<!-- DataTables -->
<script src="../dist/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../dist/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- ChartJS -->
<!-- <script src="../dist/plugins/chart.js/Chart.js"></script> -->
<!-- daterangepicker -->
<script src="../dist/plugins/moment/min/moment.min.js"></script>
<script src="../dist/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../dist/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Slimscroll -->
<script src="../dist/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../dist/plugins/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- CK Editor -->
<script src="../dist/plugins/ckeditor/ckeditor.js"></script>
<!-- Active Script -->
<script>
$(function(){
	/** add active class and stay opened when selected */
	var url = window.location;
  
	// for sidebar menu entirely but not cover treeview
	$('ul.sidebar-menu a').filter(function() {
	    return this.href == url;
	}).parent().addClass('active');

	// for treeview
	$('ul.treeview-menu a').filter(function() {
	    return this.href == url;
	}).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

});
</script>
<!-- Data Table Initialize -->
<script>
  $(function () {
    $('#example1').DataTable({
      responsive: true
    })
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
  $(function(){
    //Initialize Select2 Elements
    $('.select2').select2()

    //CK Editor
    CKEDITOR.replace('editor1')
    CKEDITOR.replace('editor2')
  });
</script>


