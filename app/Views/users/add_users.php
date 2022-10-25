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
                    <h1 class="m-0 text-dark">Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Management</li>
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item active">Tambah User</li>
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
                            <h3 class="card-title">Tambah User</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="card-text">
                        <?php   $err = session()->getFlashdata('errors'); 
                                $msg= session()->getFlashdata('success');
                                unset($_SESSION["success"]);
                                if(!isset($msg)) { ?>
                                <form method="post" action="<?php echo site_url('management/user/add') ?>">
                                    <div class="form-group">
                                        <label for="username">Username <span class="required">*</span></label>
                                        <input type="text" name="username" class="form-control <?php echo (isset($err["username"])) ? "is-invalid" : "" ?>" id="username" placeholder="Silakan isi username">
                                        <?php echo (isset($err["username"])) ? '<span class="error-invalid-feedback">' . $err["username"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="userpas">Password <span class="required">*</span></label>
                                        <input type="password" name="userpass" class="form-control <?php echo (isset($err["userpass"])) ? "is-invalid" : "" ?>" id="userpass" placeholder="Silakan isi Password">
                                        <?php echo (isset($err["userpass"])) ? '<span class="error-invalid-feedback">' . $err["userpass"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="userpas">Group User <span class="required">*</span></label>
                                        <div class="form-group">
                                            <select id="group_id" name="group_id" class="form-control">
                                                <option value=""> Pilih Salah satu Group User </option>
                                    <?php if ($groupslist) {
                                        $i=1;
                                        foreach ($groupslist as $groups) : ?>
                                            <option value="<?php echo $groups->id ?>" <?php echo (set_value('group_id')==$groups->id)?"selected='selected'":"" ?>><?php echo $groups->nama_group ?></option>
                                <?php   endforeach;
                                    } ?>                        
                                            </select>
                                        </div>
                                        <?php echo (isset($err["group_id"])) ? '<span class="error-invalid-feedback">' . $err["group_id"] . '</span>' : "" ?>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="addbtn" id="addbtn" value="add">Tambah User</button>
                                        <button type="button" class="btn btn-danger" name="backbtn" id="backbtn2" value="back" onclick='location.href="<?php echo site_url('management/user') ?>"'>Kembali</button>
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