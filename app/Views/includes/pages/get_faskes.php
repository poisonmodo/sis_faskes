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
            "responsive": true,
            "autoWidth": false,
            "columnDefs": [{
                "targets": [0],
                "orderable": false
            }]    
        });

        $("#chkall1").change(function() {
            $(".chkbox").prop("checked",this.checked);
            $("#chkall2").prop("checked",this.checked);
        })

        $("#chkall2").change(function() {
        $(".chkbox").prop("checked",this.checked);
        $("#chkall1").prop("checked",this.checked);
        })

        $(".delbtn").click(function() {
            var id = $(this).attr('id');
            $("#id_delete").val(id);  
            $("#modal-delete").modal('show');
        
        })

        //Delete Items Selected
        $(".delallbtn").click(function() {
            var chkbox = $(".chkbox:checked");
            //alert(chkbox.length);
            if(chkbox.length>0) {
                $("#modal-deleteall").modal('show');
            }
            else {
                
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: '<?php echo $site_name ?>',
                    subtitle: '',
                    body: 'Silakan Pilih Faskes yang Anda ingin hapus'
                    
                }) 
            }
            return false;
        })

        //Delete One Items  
        $("#yabtn").click(function() {
            $("#modal-delete").modal('hide');
            $.ajax({
                url:'<?php echo site_url('ajax/faskes/del') ?>',
                cache:false,
                dataType:'JSON',
                type:"post",
                data:{id:$("#id_delete").val()},
                success: function(data) {
                
                    $(document).Toasts('create', {
                        class: 'bg-success',
                        title: '<?php echo $site_name ?>',
                        subtitle: '',
                        body: data.message
                    }) 
                    setTimeout('location.href="<?php echo site_url('master/faskSes') ?>"',3000)

                }
            })    
        }) 
		
		$("#yabtn2").click(function() {
		  $("#frmlist").submit();
		  return true;  
		})
    })
</script>