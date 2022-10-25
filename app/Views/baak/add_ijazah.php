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
                        <li class="breadcrumb-item">Ijazah</li>
                        <li class="breadcrumb-item active">Tambah Ijazah</li>
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
                            <h3 class="card-title">Tambah Ijazah</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="card-text">
                        <?php   $err = session()->getFlashdata('errors'); 
                                $msg= session()->getFlashdata('success');
                                unset($_SESSION["success"]);
                                if(!isset($msg)) { ?>
                                <form method="post" action="<?php echo site_url('baak/ijazah/add/'.$nim) ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="tanggal_yudisium">Tanggal Yudisium <span class="required">*</span></label>
                                        <div class="input-group date" id="tanggal_yudisium" data-target-input="nearest">
											<input type="text" class="form-control datetimepicker-input" data-target="#tglbuat" name="tanggal_yudisium" value="<?php echo set_value('tanggal_yudisium','') ?>" />
											<div class="input-group-append" data-target="#tanggal_yudisium" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
                                        <?php echo (isset($err["tanggal_yudisium"])) ? '<span class="error-invalid-feedback">' . $err["tanggal_yudisium"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_yudisium">Tanggal Ijazah <span class="required">*</span></label>
                                        <div class="input-group date" id="tanggal_ijazah" data-target-input="nearest">
											<input type="text" class="form-control datetimepicker-input" data-target="#tglbuat" name="tanggal_ijazah" value="<?php echo set_value('tanggal_ijazah','') ?>" />
											<div class="input-group-append" data-target="#tanggal_ijazah" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
                                        <?php echo (isset($err["tanggal_ijazah"])) ? '<span class="error-invalid-feedback">' . $err["tanggal_ijazah"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_ijazah">No Jiazah <span class="required">*</span></label>
                                        <input type="text" name="no_ijazah" class="form-control <?php echo (isset($err["no_ijazah"])) ? "is-invalid" : "" ?>" id="no_ijazah" placeholder="Silakan isi Nama no_ijazah" value="<?php echo set_value('no_ijazah','') ?>">
                                        <?php echo (isset($err["no_ijazah"])) ? '<span class="error-invalid-feedback">' . $err["no_ijazah"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">    
                                        <label for="photo">photo</label><br>
                                        <input type="file" name="photo" class="<?php echo (isset($err["photo"])) ? "is-invalid" : "" ?>" id="photo" placeholder="Silakan upload photo">
                                        <?php echo (isset($err["photo"])) ? '<span class="error-invalid-feedback">' . $err["photo"] . '</span>' : "" ?>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="addbtn" id="addbtn" value="add">Tambah Jiazah</button>
                                        <button type="button" class="btn btn-danger" name="backbtn" id="backbtn2" value="back" onclick='location.href="<?php echo site_url('baak/jiazah') ?>"'>Kembali</button>
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
                                    setTimeout('location.href="<?php echo site_url($uri->getSegment(1)."/".$uri->getSegment(2)."/".$nim) ?>"',3000)
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