<!-- AdminLTE App -->
<script src="<?php echo site_url('assets/js/adminlte.min.js') ?>"></script>
<script src="<?php echo site_url('assets/js/demo.js') ?>"></script>
<script src="<?php echo site_url('plugins/moment/moment.min.js') ?>"></script>
<script src="<?php echo site_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<!-- <script src="<?php echo site_url('assets/js/select2.min.js') ?>"></script> -->
<script>
	$(function() {
		$("#nim").keyup(function(e) {
			e.preventDefault();
			var nim_mhs= $(this).val();
			var n = nim_mhs.length; 
			if(n>7) {
				$.ajax({
					url:'<?php echo site_url('ajax/student/nim') ?>',
					cache:false,
					dataType:'json',
					data:{nim:nim_mhs},
					type:'POST',
					success: function(dat) {
						if(dat.data.nim) {
							$("#nama_mahasiswa").val(dat.data.nama_lengkap);
						}
					}
				})
			}
		})
	})
</script>