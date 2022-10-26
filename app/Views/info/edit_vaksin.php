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
                    <h1 class="m-0 text-dark">Info</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Info</li>
                        <li class="breadcrumb-item">Vaksin</li>
                        <li class="breadcrumb-item active">Edit Vaksin</li>
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
                            <h3 class="card-title">Edit Vaksin di <?php echo $info_faskes; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="card-text">
                        <?php   $err = session()->getFlashdata('errors'); 
                                $msg= session()->getFlashdata('success');
                                unset($_SESSION["success"]);
                                if(!isset($msg)) { ?>
                                <form method="post" action="<?php echo site_url('info/vaksin/edit/'.$faskes_id.'/'.$id) ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="vaksin_name">Nama Vaksin <span class="required">*</span></label>
                                        <select class="form-control" name="vaksin_id" id="vaksin_id">
											<option value="">Pilih Salah Salah Satu vaksin</option>

<?php if($vaksinlist) { 
	    foreach($vaksinlist as $vaksin) { ?>
											<option value="<?php echo $vaksin->id ?>" <?php echo ($vaksin->id==$fvaksin->vaksin_id)?"selected='selected'":"" ?>><?php echo $fvaksin->vaksin_name ?></option>
<?php 	}
	  } ?>		
										</select>
                                        <?php echo (isset($err["vaksin_name"])) ? '<span class="error-invalid-feedback">' . $err["vaksin_name"] . '</span>' : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="kouta">Kouta <span class="required">*</span></label>
                                        <input type="text" name="kouta" class="form-control <?php echo (isset($err["kouta"])) ? "is-invalid" : "" ?>" id="kouta" placeholder="Silakan isi kouta" value="<?php echo $fvaksin->kouta ?>">
                                        <?php echo (isset($err["kouta"])) ? '<span class="error-invalid-feedback">' . $err["kouta"] . '</span>' : "" ?>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="editbtn" id="editbtn" value="Update">Update Vaksin</button>
                                        <button type="button" class="btn btn-danger" name="backbtn" id="backbtn2" value="back" onclick='location.href="<?php echo site_url('Info/vaksin') ?>"'>Kembali</button>
                                        <p>
                                            <span class="required">*</span> Wajib   
                                        <p>
                                    </div>
                                </form>
                        <?php   } 
                                else { ?>
                                <div class="alert alert-success">
                        <?php       echo $msg; ?>                  
                                </div>
                                <script type="text/javascript">
                                    setTimeout('location.href="<?php echo site_url($uri->getSegment(1)."/".$uri->getSegment(2)."/list/".$uri->getSegment(4)) ?>"',3000)
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