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
                        <li class="breadcrumb-item">Dosen</li>
                        <li class="breadcrumb-item active">Edit Dosen</li>
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
                            <h3 class="card-title">Edit Dosen</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="card-text">
                        <?php   $err = session()->getFlashdata('errors'); 
                                $msg= session()->getFlashdata('success');
                                unset($_SESSION["success"]);
                                if(!isset($msg)) { ?>
                                <form method="post" action="<?php echo site_url('master/lecturers/edit/'.$id) ?>">
                                    <div class="form-group">
                                        <label for="nik">NIK <span class="required">*</span></label>
                                        <input type="text" readonly="readonly" name="nik" class="form-control <?php echo (isset($err["nik"])) ? "is-invalid" : "" ?>" id="nik" placeholder="Silakan isi nik" value="<?php echo $lecturer->nik ?>">
                                        <?php echo (isset($err["nik"])) ? '<span class="error-invalid-feedback">' . $err["nik"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_dosen">Nama Dosen <span class="required">*</span></label>
                                        <input type="text" name="nama_dosen" class="form-control <?php echo (isset($err["nama_dosen"])) ? "is-invalid" : "" ?>" id="nama_dosen" placeholder="Silakan isi Nama Dosen" value="<?php echo $lecturer->nama_dosen ?>">
                                        <?php echo (isset($err["nama_dosen"])) ? '<span class="error-invalid-feedback">' . $err["nama_dosen"] . '</span>' : "" ?>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="editbtn" id="editbtn" value="update">Update Dosen</button>
                                        <button type="button" class="btn btn-danger" name="backbtn" id="backbtn2" value="back" onclick='location.href="<?php echo site_url('master/lecturers') ?>"'>Kembali</button>
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