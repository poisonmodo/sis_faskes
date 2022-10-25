<?php
echo view('includes/header');
$uri = service('uri');
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
                        <li class="breadcrumb-item">Daftar Jurusan</li>
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
                            <h3 class="card-title">Jurusan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="card-text">
                        <?php   $err = session()->getFlashdata('errors'); 
                                $msg= session()->getFlashdata('success');  
                                if($msg) { ?> 
                                <div class="alert alert-success">
                        <?php       echo $msg; ?>                  
                                </div>
                                <script type="text/javascript">
                                    setTimeout('location.href="<?php echo site_url($uri->getSegment(1)."/".$uri->getSegment(2)) ?>"',3000)
                                </script>
                        <?php   } ?>        
                                <form method="post" action="<?php echo site_url('master/jurusan') ?>" id="frmlist">
                                    <input type="hidden" name="delall" id="delall" value="1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary" name="addbtn" id="addbtn1" onclick='location.href="<?php echo site_url('master/jurusan/add') ?>"'>Tambah Jurusan</button>
                                            <button type="submit" class="btn btn-danger delallbtn" name="delallbtn" id="delallbtn1" value="del">Hapus Jurusan</button>
                                        </div>
                                    </div>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="col-sm-1">
                                                    <input type="checkbox" id="chkall1" class="chkall" value="1">
                                                </th>
                                                <th class="col-sm-10">Nama Jurusan</th>
                                                <th class="col-sm-1">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php if ($jurusanlist) {
                                                $i=1;
                                                // $generator = new Barcode\BarcodeGeneratorHTML();
                                                foreach ($jurusanlist as $jurusan) : ?>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="chkbox[]" id="chkbox<?php echo $i ?>" class="chkbox" value="<?php echo $jurusan->id ?>">
                                                        </td>
                                                        <td>
                                                            <?php echo $jurusan->jurusan ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo site_url('master/jurusan/edit/'.$jurusan->id) ?>" data-toggle="tooltip" title="Edit Jurusan"><i class="fa fa-edit"></i></a>
                                                            <a href="#"  title="Hapus Jurusan" id="<?php echo $jurusan->id ?>" class="delbtn" onclick="return false;"><i class="fa fa-minus-square"></i></a>    
                                                        </td>   	
                                                    </tr>
                                    <?php 
                                                    $i++;    
                                                endforeach;
                                          }
                                          else {  ?>
                                                    <tr>
                                                        <td colspan="4" class="text-center">Data tidak ditemukan</td>
                                                        
                                                    </tr>
                                    <?php } ?>      
                                        </tbody>
                                        <tfoot>
                                            <th>
												<input type="checkbox" id="chkall2" class="chkal2" value="1">
											</th>
											<th>Nama Jurusan</th>
											<th>Aksi</th>
                                        </tfoot>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary" name="addbtn2" id="addbtn2" onclick='location.href="<?php echo site_url('master/jurusan/add') ?>"'>Tambah Jurusan</button>
                                            <button type="submit" class="btn btn-danger delallbtn" name="delallbtn" id="delallbtn2" value="del">Hapus Jurusan</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="modal fade" id="modal-delete">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h4 class="modal-title">Hapus Jurusan</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="frmdel">
                                                    <input type="hidden" name="cat_id" id="id_delete" value="">
                                                    <p>Apakah Anda yakin hapus Jurusan?</p>
                                                </form>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                                                <button type="button" class="btn btn-primary" id="yabtn">Ya</button>
                                            </div>
                                        </div>
                                    <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div> 
                                <div class="modal fade" id="modal-deleteall">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h4 class="modal-title">Hapus Jurusan</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin hapus Jurusan ini?</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                                                <button type="button" class="btn btn-primary" id="yabtn2">Ya</button>
                                            </div>
                                        </div>
                                    <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div> 
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