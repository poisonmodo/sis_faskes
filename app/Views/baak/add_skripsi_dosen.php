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
                        <li class="breadcrumb-item">Skripsi</li>
                        <li class="breadcrumb-item active">Tambah Dosen</li>
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
<?php if(strlen($infoskripsi->judul_skripsi)>19) {      
        $ket=substr($infoskripsi->judul_skripsi,0,20)."...";
      }
      else {
        $ket = $infoskripsi->judul_skripsi;
      }   
?>                         
                              
                            <h3 class="card-title">Tambah Dosen <?php echo $ket; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="card-text">
                        <?php   $err = session()->getFlashdata('errors'); 
                                $msg= session()->getFlashdata('success');
                                unset($_SESSION["success"]);
                                if(!isset($msg)) { ?>
                                <form method="post" action="<?php echo site_url('baak/skripsi/dosen/add/'.$id) ?>">
                                    <div class="form-group">
                                        <label for="nim">Nama Dosen <span class="required">*</span></label>
                                        <select class="form-control" name="nik" id="nik">
											<option value=""></option>

<?php if($dosenlist) { 
		foreach($dosenlist as $dosen) { ?>
											<option value="<?php echo $dosen->nik ?>" <?php echo ($dosen->nik==set_value('nik'))?"selected='selected'":"" ?>><?php echo $dosen->nama_dosen ?></option>
<?php 	}
	  } ?>		
										</select>
                                        <?php echo (isset($err["nik"])) ? '<span class="error-invalid-feedback">' . $err["nik"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="stock_type">Posisi</label>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="posisi" id="posisi" value="1" <?php echo (set_value('posisi')==1)?"checked='checked'":"" ?>> 
                                                <label for="posisi" class="form-check-label">Pembimbing</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="posisi" id="posisi" value="2"  <?php echo (set_value('posisi')==2)?"checked='checked'":"" ?>> 
                                                <label for="posisi" class="form-check-label" >Penguji I</label>
                                            </div>
											<div class="form-check">
                                                <input class="form-check-input" type="radio" name="posisi" id="posisi" value="3"  <?php echo (set_value('posisi')==3)?"checked='checked'":"" ?>> 
                                                <label for="posisi" class="form-check-label" >Penguji II</label>
                                            </div>
                                        </div>
                                        <?php echo (isset($err["posisi"])) ? '<span class="error-invalid-feedback">' . $err["posisi"] . '</span>' : "" ?>
                                    </div>
									<div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control <?php echo (isset($err["deskripsi"])) ? "is-invalid" : "" ?>" id="deskripsi" placeholder="Silakan isi deskripsi"><?php echo set_value('deskripsi','') ?></textarea>
                                        <?php echo (isset($err["deskripsi"])) ? '<span class="error-invalid-feedback">' . $err["deskripsi"] . '</span>' : "" ?>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="addbtn" id="addbtn" value="add">Tambah Dosen</button>
                                        <button type="button" class="btn btn-danger delallbtn" name="backbtn" id="backbtn" value="back" onclick='location.href="<?php echo site_url('baak/skripsi/dosen/'.$id) ?>"'>Kembali</button>
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
                                    setTimeout('location.href="<?php echo site_url($uri->getSegment(1)."/".$uri->getSegment(2)."/".$uri->getSegment(3)."/".$id) ?>"',3000)
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