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
                    <h1 class="m-0 text-dark">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">User</li>
                        <li class="breadcrumb-item">Ganti Password</li>
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
                            <h3 class="card-title">Ganti Password</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="card-text">
                        <?php   $err = session()->getFlashdata('errors');
                                $err2 = session()->getFlashdata('error_message'); 
                                $msg= session()->getFlashdata('success');
                                if(!isset($msg)) {
                                    if($err2) { ?>
                                <div class="alert alert-danger">
                        <?php echo $err2 ?>                
                                </div>        
                        <?php       }
                        ?>
                                <form method="post" action="<?php echo site_url('changepassword') ?>">
                                    <div class="form-group">
                                        <label for="oldpass">Password lama <span class="required">*</span></label>
                                        <input type="password" name="oldpass" class="form-control <?php echo (isset($err["oldpass"])) ? "is-invalid" : "" ?>" id="oldpass" placeholder="Silakan isi Password Lama Anda">
                                        <?php echo (isset($err["oldpass"])) ? '<span class="error-invalid-feedback">' . $err["oldpass"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="newpass1">Password Baru <span class="required">*</span></label>
                                        <input type="password" name="newpass1" class="form-control <?php echo (isset($err["newpass1"])) ? "is-invalid" : "" ?>" id="newpass1" placeholder="Silakan isi Password Baru Anda">
                                        <?php echo (isset($err["newpass1"])) ? '<span class="error-invalid-feedback">' . $err["newpass1"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="newpass2">Konfirmasi Password Baru <span class="required">*</span></label>
                                        <input type="password" name="newpass2" class="form-control <?php echo (isset($err["newpass2"])) ? "is-invalid" : "" ?>" id="newpass2" placeholder="Silakan isi Konfirmasi Password Baru Anda">
                                        <?php echo (isset($err["newpass2"])) ? '<span class="error-invalid-feedback">' . $err["newpass2"] . '</span>' : "" ?>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="changebtn" id="changebtn" value="change">Ganti Password</button>
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