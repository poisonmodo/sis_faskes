<?php 
echo view('includes/header');
$uri = service('uri');
$request = service('request');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">BAAK</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">BAAK</li>
                        <li class="breadcrumb-item">Check list</li>
                        <li class="breadcrumb-item active">Tambah Dokumen</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Dokumen</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="card-text">
                        <?php   $err = session()->getFlashdata('errors'); 
                                $msg= session()->getFlashdata('success');
                                unset($_SESSION["success"]);
                                if(!isset($msg)) { ?>
                                <form method="post" action="<?php echo site_url('baak/checklist/add/'.$skripsi_id) ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="param_id">Keterangan <span class="required">*</span></label>
                                        <select class="form-control" name="param_id" id="param_id">
											<option value="">Pilih Salah Stau Keterangan</option>

<?php if($paramlist) { 
		foreach($paramlist as $param) { ?>
											<option value="<?php echo $param->id ?>" <?php echo ($param->id==set_value('param_id'))?"selected='selected'":"" ?>><?php echo $param->param_name ?></option>
<?php 	}
	  } ?>		
										</select>
                                        <?php echo (isset($err["param_id"])) ? '<span class="error-invalid-feedback">' . $err["param_id"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="param_id">Foto <span class="required">*</span></label><br>
                                        <input type="file" name="document" id="document">
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="addbtn" id="addbtn" value="add">Tambah Dokumen</button>
                                        <button type="button" class="btn btn-danger delallbtn" name="backbtn" id="backbtn" value="back" onclick='location.href="<?php echo site_url('baak/checklist/'.$skripsi_id) ?>"'>Kembali</button>
                                        <p>
                                            <span class="required">*</span> Wajib diisi
                                        <p>
                                    </div>
                                </form>
                        <?php   } 
                                else { ?>
                                <div class="alert alert-success">
                        <?php       echo $msg; ?>                  
                                </div>
                                <script type="text/javascript">
                                    setTimeout('location.href="<?php echo site_url($uri->getSegment(1)."/".$uri->getSegment(2)."/".$skripsi_id) ?>"',3000)
                                </script>
                        <?php   } ?>           
                            </p>
                        </div>
                        
                    </div>
                </div>
                <!-- /.col-md-6 -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>
<!-- /.control-sidebar -->

<?php echo view('includes/footer') ?>