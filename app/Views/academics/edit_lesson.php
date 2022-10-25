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
                        <li class="breadcrumb-item">Mata Kuliah</li>
                        <li class="breadcrumb-item active">Edit Mata Kuliah</li>
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
                            <h3 class="card-title">Edit Mata Kuliah</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="card-text">
                        <?php   $err = session()->getFlashdata('errors'); 
                                $msg= session()->getFlashdata('success');
                                unset($_SESSION["success"]);
                                if(!isset($msg)) { ?>
                                <form method="post" action="<?php echo site_url('master/lesson/edit/'.$id) ?>">
                                    <div class="form-group">
                                        <label for="kode_matakuliah">Kode Mata Kuliah <span class="required">*</span></label>
                                        <input readonly="readonly" type="text" name="kode_matakuliah" class="form-control <?php echo (isset($err["kode_matakuliah"])) ? "is-invalid" : "" ?>" id="kode_matakuliah" placeholder="Silakan isi Kode Mata Kuliah" value="<?php echo $lesson->kode_matakuliah ?>">
                                        <?php echo (isset($err["kode_matakuliah"])) ? '<span class="error-invalid-feedback">' . $err["kode_matakuliah"] . '</span>' : "" ?>
                                    </div>
									<div class="form-group">
                                        <label for="nama_matakuliah">Nama Mata Kuliah <span class="required">*</span></label>
                                        <input type="text" name="nama_matakuliah" class="form-control <?php echo (isset($err["nama_matakuliah"])) ? "is-invalid" : "" ?>" id="nama_matakuliah" placeholder="Silakan isi Nama Mata Kuliah" value="<?php echo $lesson->nama_matakuliah ?>">
                                        <?php echo (isset($err["nama_matakuliah"])) ? '<span class="error-invalid-feedback">' . $err["nama_matakuliah"] . '</span>' : "" ?>
                                    </div>
									<div class="form-group">
                                        <label for="sks">SKS <span class="required">*</span></label>
                                        <input type="text" name="sks" class="form-control <?php echo (isset($err["sks"])) ? "is-invalid" : "" ?>" id="sks" placeholder="Silakan isi SKS" value="<?php echo $lesson->sks ?>">
                                        <?php echo (isset($err["sks"])) ? '<span class="error-invalid-feedback">' . $err["sks"] . '</span>' : "" ?>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="editbtn" id="editbtn" value="update">Update Mata Kuliah</button>
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