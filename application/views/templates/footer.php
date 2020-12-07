</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url()?>assets/js/jquery-3.2.1.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="<?php echo base_url()?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>

<!-- Slimscroll JS -->
<script src="<?php echo base_url()?>assets/js/jquery.slimscroll.min.js"></script>

<!-- Select2 JS -->
<script src="<?php echo base_url()?>assets/js/select2.min.js"></script>

<!-- Datatable JS -->
<script src="<?php echo base_url()?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/js/dataTables.bootstrap4.min.js"></script>

<!-- Custom JS -->
<script src="<?php echo base_url()?>assets/js/app.js"></script>


<!-- Export datatable -->
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>


<!-- Script -->

<!-- Script JS Select2 Form Option -->
<script type="text/javascript">
$(document).ready(function() {
  $('.js-select2').select2();
});
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.export_datatable').DataTable( {
      dom: 'Bfrtip',
        buttons: [
            'copy', 'excel',
        ]
    } );
  } );
</script>

</body>
</html>
