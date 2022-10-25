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
                        <li class="breadcrumb-item">Faskes</li>
                        <li class="breadcrumb-item active">Tambah Faskes</li>
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
                            <h3 class="card-title">Tambah Faskes</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="card-text">
                        <?php   $err = session()->getFlashdata('errors'); 
                                $msg= session()->getFlashdata('success');
                                unset($_SESSION["success"]);
                                if(!isset($msg)) { ?>
                                <form method="post" action="<?php echo site_url('master/faskes/add') ?>">
                                    <div class="form-group">
                                        <label for="nik">Tipe Faskes<span class="required">*</span></label>
                                        <select class="form-control" name="faskes_type" id="faskes_type">
											<option value="">Pilih Salah Salah Satu Tipe Faskes</option>    
                                            <option value="1" <?php echo (1==set_value('faskes_type'))?"selected='selected'":"" ?>>Puskesmas</option>
                                            <option value="2" <?php echo (2==set_value('faskes_type'))?"selected='selected'":"" ?>>Rumah Sakit</option>
                                            <option value="3" <?php echo (3==set_value('faskes_type'))?"selected='selected'":"" ?>>Klinik</option>	
										</select>
                                        <?php echo (isset($err["faskes_type"])) ? '<span class="error-invalid-feedback">' . $err["faskes_type"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="faskes_name">Nama Faskes <span class="required">*</span></label>
                                        <input type="text" name="faskes_name" class="form-control <?php echo (isset($err["faskes_name"])) ? "is-invalid" : "" ?>" id="faskes_name" placeholder="Silakan isi Nama Faskes" value="<?php echo set_value('faskes_name','') ?>">
                                        <?php echo (isset($err["faskes_name"])) ? '<span class="error-invalid-feedback">' . $err["faskes_name"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="faskes_address">Alamat Faskes <span class="required">*</span></label>
                                        <textarea name="faskes_address" class="form-control <?php echo (isset($err["faskes_address"])) ? "is-invalid" : "" ?>" id="faskes_address" placeholder="Silakan isi Alamat Faskes"><?php echo set_value('faskes_address','') ?></textarea>
                                        <?php echo (isset($err["faskes_address"])) ? '<span class="error-invalid-feedback">' . $err["faskes_address"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="faskes_phone">No Telepon Faskes <span class="required">*</span></label>
                                        <input type="text" name="faskes_phone" class="form-control <?php echo (isset($err["faskes_phone"])) ? "is-invalid" : "" ?>" id="faskes_phone" placeholder="Silakan isi No Telepon Faskes" value="<?php echo set_value('faskes_phone','') ?>">
                                        <?php echo (isset($err["faskes_phone"])) ? '<span class="error-invalid-feedback">' . $err["faskes_phone"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="city_id">Kota <span class="required">*</span></label>
                                        <select class="form-control" name="city_id" id="city_id">
											<option value="">Pilih Salah Salah Satu Kota</option>

<?php if($citylist) { 
	    foreach($citylist as $city) { ?>
											<option value="<?php echo $city->id ?>" <?php echo ($city->id==set_value('city_id'))?"selected='selected'":"" ?>><?php echo $city->city ?></option>
<?php 	}
	  } ?>		
										</select>
                                        <?php echo (isset($err["city_id"])) ? '<span class="error-invalid-feedback">' . $err["city_id"] . '</span>' : "" ?>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="addbtn" id="addbtn" value="add">Tambah Faskes</button>
                                        <button type="button" class="btn btn-danger" name="backbtn" id="backbtn2" value="back" onclick='location.href="<?php echo site_url('master/faskes') ?>"'>Kembali</button>
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