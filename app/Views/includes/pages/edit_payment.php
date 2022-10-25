<!-- AdminLTE App -->
<script src="<?php echo site_url('assets/js/adminlte.min.js') ?>"></script>
<script src="<?php echo site_url('assets/js/demo.js') ?>"></script>
<script src="<?php echo site_url('plugins/moment/moment.min.js') ?>"></script>
<script src="<?php echo site_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<script src="<?php echo site_url('assets/js/select2.min.js') ?>"></script>
<script>
	$(function() {
		//$('#nim').select2();
		$("#tgl_bayar").datetimepicker({
			format: 'L',
			'date': moment("<?php echo $payment->tgl_bayar ?>")
		});

		// $("#tgl_penerimaan_skripsi").datetimepicker({
		// 	format: 'L'
		// });
	})
</script>