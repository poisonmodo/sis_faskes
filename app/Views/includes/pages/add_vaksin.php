<!-- AdminLTE App -->
<script src="<?php echo site_url('assets/js/adminlte.min.js') ?>"></script>
<script src="<?php echo site_url('assets/js/demo.js') ?>"></script>
<script src="<?php echo site_url('plugins/moment/moment.min.js') ?>"></script>
<script src="<?php echo site_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<script>
	$(function() {
		$("#tgl_lahir").datetimepicker({
			format: 'L',
            date: '<?php echo set_value('tgl_lahir','') ?>'
		});
	})
</script>