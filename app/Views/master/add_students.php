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
                    <h1 class="m-0 text-dark">Master</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Master</li>
                        <li class="breadcrumb-item">Mahasiswa</li>
                        <li class="breadcrumb-item active">Tambah Mahasiswa</li>
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
                            <h3 class="card-title">Tambah Mahasiswa</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="card-text">
                        <?php   $err = session()->getFlashdata('errors'); 
                                $msg= session()->getFlashdata('success');
                                unset($_SESSION["success"]);
                                if(!isset($msg)) { ?>
                                <form method="post" action="<?php echo site_url('master/students/add') ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="nim">NIM <span class="required">*</span></label>
                                        <input type="text" name="nim" class="form-control <?php echo (isset($err["nim"])) ? "is-invalid" : "" ?>" id="nim" placeholder="Silakan isi NIM" value="<?php echo set_value('nim','') ?>">
                                        <?php echo (isset($err["nim"])) ? '<span class="error-invalid-feedback">' . $err["nim"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_mahasiswa">Nama Mahasiswa <span class="required">*</span></label>
                                        <input type="text" name="nama_mahasiswa" class="form-control <?php echo (isset($err["nama_mahasiswa"])) ? "is-invalid" : "" ?>" id="nama_mahasiswa" placeholder="Silakan isi Nama Mahasiswa" value="<?php echo set_value('nama_mahasiswa','') ?>">
                                        <?php echo (isset($err["nama_mahasiswa"])) ? '<span class="error-invalid-feedback">' . $err["nama_mahasiswa"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="stock_type">Jenis Kelamin</label>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="1" <?php echo (set_value('jenis_kelamin')==1)?"checked='checked'":"" ?>> 
                                                <label for="jenis_kelamin" class="form-check-label">Pria</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="2" <?php echo (set_value('jenis_kelamin')==2)?"checked='checked'":"" ?>> 
                                                <label for="jenis_kelamin" class="form-check-label" >Wanita</label>
                                            </div>
                                        </div>
                                        <?php echo (isset($err["jenis_kelamin"])) ? '<span class="error-invalid-feedback">' . $err["jenis_kelamin"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="nim">no KTP <span class="required">*</span></label>
                                        <input type="text" name="no_identitas" class="form-control <?php echo (isset($err["no_identitas"])) ? "is-invalid" : "" ?>" id="no_identitas" placeholder="Silakan isi No KTP" value="<?php echo set_value('no_identitas','') ?>">
                                        <?php echo (isset($err["no_identitas"])) ? '<span class="error-invalid-feedback">' . $err["no_identitas"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir <span class="required">*</span></label>
                                        <input type="text" name="tempat_lahir" class="form-control <?php echo (isset($err["tempat_lahir"])) ? "is-invalid" : "" ?>" id="tempat_lahir" placeholder="Silakan isi Tempat Lahir" value="<?php echo set_value('tempat_lahir','') ?>">
                                        <?php echo (isset($err["tempat_lahir"])) ? '<span class="error-invalid-feedback">' . $err["tempat_lahir"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_lahir">Tanggal Lahir <span class="required">*</span></label>
                                        <div class="input-group date" id="tgl_lahir" data-target-input="nearest">
											<input type="text" class="form-control datetimepicker-input" data-target="#tglbuat" name="tgl_lahir" value="<?php echo set_value('tgl_lahir','') ?>" />
											<div class="input-group-append" data-target="#tgl_lahir" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
                                    </div>    
                                    <div class="form-group">
                                        <label for="nama_ortu">Nama Orang Tua/Wali <span class="required">*</span></label>
                                        <input type="text" name="nama_ortu" class="form-control <?php echo (isset($err["nama_ortu"])) ? "is-invalid" : "" ?>" id="nama_ortu" placeholder="Silakan isi Nama Orang Tua/Wali" value="<?php echo set_value('nama_ortu','') ?>">
                                        <?php echo (isset($err["nama_ortu"])) ? '<span class="error-invalid-feedback">' . $err["nama_ortu"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat_ortu">Alamat Orang Tua/Wali <span class="required">*</span></label>
                                        <textarea name="alamat_ortu" class="form-control" id="alamat_ortu" placeholder="Silakan isi Alamat Orang Tua/Wali"><?php echo set_value('alamat_ortu','') ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="jurusan">Jurusan <span class="required">*</span></label>
                                        <select class="form-control" name="jurusan_id"id="jurusan_id">
											<option value="">Pilih Salah satu Jurusan</option>
<?php if($jurusanlist) {
		foreach($jurusanlist as $jurusan) { ?>
											<option value="<?php echo $jurusan->id ?>" <?php echo (set_value('jurusan_id')==$jurusan->id)?"selected='selected'":"" ?>><?php echo $jurusan->jurusan ?></option>
<?php 	} 
	  }	
?>											
										</select>
                                        <?php echo (isset($err["jurusan_id"])) ? '<span class="error-invalid-feedback">' . $err["jurusan_id"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun_akademik">Tahun Akademik <span class="required">*</span></label>
                                        <input type="text" name="tahun_akademik" class="form-control <?php echo (isset($err["tahun_akademik"])) ? "is-invalid" : "" ?>" id="kota" placeholder="Silakan isi Tahun Akademik">
                                        <?php echo (isset($err["tahun_akademik"])) ? '<span class="error-invalid-feedback">' . $err["tahun_akademik"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">    
                                        <label for="photo">photo</label><br>
                                        <input type="file" name="photo" class="<?php echo (isset($err["photo"])) ? "is-invalid" : "" ?>" id="photo" placeholder="Silakan upload photo">
                                        <?php echo (isset($err["photo"])) ? '<span class="error-invalid-feedback">' . $err["photo"] . '</span>' : "" ?>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="addbtn" id="addbtn" value="add">Tambah Mahasiswa</button>
                                        <button type="button" class="btn btn-danger" name="backbtn" id="backbtn2" value="back" onclick='location.href="<?php echo site_url('master/students') ?>"'>Kembali</button>
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
                                    setTimeout('location.href="<?php echo site_url($uri->getSegment(1)."/".$uri->getSegment(2)) ?>"',3000)
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