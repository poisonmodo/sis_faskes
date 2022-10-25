<!-- AdminLTE App -->
<script src="<?php echo site_url('assets/js/adminlte.min.js') ?>"></script>
<script src="<?php echo site_url('assets/js/demo.js') ?>"></script>
<script src="<?php echo site_url('assets/js/select2.min.js') ?>"></script>
<script src="<?php echo site_url('plugins/moment/moment.min.js') ?>"></script>
<script src="<?php echo site_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<script>
	$(function() {
		$("#no_ijazah").removeAttr('disabled');
		
		$("#tanggal_yudisium").datetimepicker({
			format: 'L',
            date: '<?php echo $ijazah->tanggal_yudisium ?>'
		});

		$("#tanggal_ijazah").datetimepicker({
			format: 'L',
            date: '<?php echo $ijazah->tanggal_ijazah ?>'
		});
    });
</script>