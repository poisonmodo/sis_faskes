<script src="<?php echo site_url('plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo site_url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo site_url('plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?php echo site_url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>  "></script>
<!-- AdminLTE App -->
<script src="<?php echo site_url('assets/js/adminlte.min.js') ?>"></script>
<script src="<?php echo site_url('assets/js/demo.js') ?>"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            "searching":false;
            "responsive": true,
            "autoWidth": false,
            "columnDefs": [{
                "targets": [0],
                "orderable": false
            }]    
        });

        $("#thn_ajaran").select();
    });
</script>