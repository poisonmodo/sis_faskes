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
                        <li class="breadcrumb-item">Yudisium</li>
                        <li class="breadcrumb-item active">Edit Yudisium</li>
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
                            <h3 class="card-title">Edit Yudisium  <?php echo $nim." - ".$student_name ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="card-text">
                        <?php   $err = session()->getFlashdata('errors'); 
                                $msg= session()->getFlashdata('success');
                                unset($_SESSION["success"]);
                                if(!isset($msg)) { ?>
                                <form method="post" action="<?php echo site_url('baak/yudisium/edit/'.$nim.'/'.$id) ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="nim">Nama Dokumen <span class="required">*</span></label>
                                        <select class="form-control" name="id_dokumen" id="id_dokumen">
											<option value="">Pilih Salah Satu dokumen</option>

<?php if($docslist) { 
		foreach($docslist as $docs) { ?>
											<option value="<?php echo $docs->id ?>" <?php echo ($docs->id == $yudisium->id_dokumen)?"selected='selected'":"" ?>><?php echo $docs->nama_dokumen ?></option>
<?php 	}
	  } ?>		
										</select>
                                        <?php echo (isset($err["id_dokumen"])) ? '<span class="error-invalid-feedback">' . $err["id_dokumen"] . '</span>' : "" ?>
                                    </div>
									<div class="form-group">
                                        <label for="photo">Scan Document</label><br>
<?php                         $path=FCPATH."/images/yudisium";
                              $imgpath = $path."/".$yudisium->nim; 
                              $imgurl = site_url("images/yudisium/".$yudisium->nim."/".$yudisium->filename);      
                              if(file_exists($imgpath."/".$yudisium->filename)) { ?>
                                        <img src="<?php echo $imgurl ?>" width="125px" /><br>    
                        <?php }  ?>                                                        
                                        <input type="file" name="photo" class="<?php echo (isset($err["photo"])) ? "is-invalid" : "" ?>" id="photo" placeholder="Silakan upload photo">
                                        <?php echo (isset($err["photo"])) ? '<span class="error-invalid-feedback">' . $err["photo"] . '</span>' : "" ?>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="editbtn" id="editbtn" value="add">Update Yudisium</button>
                                        <button type="button" class="btn btn-danger" name="backbtn" id="backbtn2" value="back" onclick='location.href="<?php echo site_url('baak/Yudisium') ?>"'>Kembali</button>
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
                                    setTimeout('location.href="<?php echo site_url($uri->getSegment(1)."/".$uri->getSegment(2).'/'.$nim) ?>"',3000)
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