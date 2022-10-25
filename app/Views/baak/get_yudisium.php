<?php
echo view('includes/header');
$uri = service('uri');
$LecturersModel = new \App\Models\LecturersModel();
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
                        <li class="breadcrumb-item">Daftar Yudisium</li>
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
                            <h3 class="card-title">Yudisium <?php echo $nim." - ".$student_name ?> </h3>
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
                                    setTimeout('location.href="<?php echo site_url($uri->getSegment(1)."/".$uri->getSegment(2)."/".$nim) ?>"',3000)
                                </script>
                        <?php   } ?>        
                                <form method="post" action="<?php echo site_url('baak/yudisium/'.$nim) ?>" id="frmlist">
                                    <input type="hidden" name="delall" id="delall" value="1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary" name="addbtn" id="addbtn1" onclick='location.href="<?php echo site_url('baak/yudisium/add/'.$nim) ?>"'>Tambah Yudisium</button>
                                            <button type="submit" class="btn btn-danger delallbtn" name="delallbtn" id="delallbtn1" value="del">Hapus Yudisium</button>
                                            <button type="button" class="btn btn-danger backbtn" name="backbtn" id="backbtn1" value="back" onclick='location.href="<?php echo site_url('baak/students/yudisium') ?>"'>Kembali</button>
                                        </div>
                                    </div>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" id="chkall1" class="chkall" value="1">
                                                </th>
                                                <th>Nama Dokumen</th>
                                                <th>Foto Dokumen</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php if ($yudisiumlist) {
                                                $i=1;
                                                
                                                // $generator = new Barcode\BarcodeGeneratorHTML();
                                                foreach ($yudisiumlist as $yudisium) : ?>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="chkbox[]" id="chkbox<?php echo $i ?>" class="chkbox" value="<?php echo $yudisium->id ?>">
                                                        </td>
                                                        <td>
                                                            <?php echo $yudisium->nama_dokumen ?>
                                                        </td>
                                                        <td>
                                    <?php $path= FCPATH."/images/yudisium/".$nim;
                                          $photopath = $path."/".$yudisium->filename;
                                          $photourl = site_url("images/yudisium/".$nim."/".$yudisium->filename);
                                          if($yudisium->filename && file_exists($photopath)) { ?>
                                            
                                                            <img src="<?php echo $photourl ?>" class="photo_yudisium">
                                    <?php } ?>

                                                        </td>
                                                        <td>
                                                            <a href="<?php echo site_url('baak/yudisium/edit/'.$nim."/".$yudisium->id) ?>" data-toggle="tooltip" title="Edit Data Yudisium"><i class="fa fa-edit"></i></a>
                                                            <a href="#"  title="Hapus Yudisium" id="<?php echo $yudisium->id ?>" class="delbtn" onclick="return false;"><i class="fa fa-minus-square"></i></a>    
                                                        </td>   
                                                    </tr>
                                    <?php 
                                                    $i++;    
                                                endforeach;
                                          }
                                          else {  ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">Data tidak ditemukan</td>
                                                        
                                                    </tr>
                                    <?php } ?>      
                                        </tbody>
                                        <tfoot>
                                            <th>
                                                <input type="checkbox" id="chkall2" class="chkal2" value="1">
                                            </th>
											<th>Nama Dokumen</th>
                                            <th>Foto Dokumen</th>
                                            <th>Aksi</th>
                                        </tfoot>
                                    </table>    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary" name="addbtn2" id="addbtn2" onclick='location.href="<?php echo site_url('baak/yudisium/add/'.$nim) ?>"'>Tambah Yudisium</button>
                                            <button type="submit" class="btn btn-danger delallbtn" name="delallbtn" id="delallbtn2" value="del">Hapus Yudisium</button>
                                            <button type="button" class="btn btn-danger backbtn" name="backbtn" id="backbtn2" value="back" onclick='location.href="<?php echo site_url('baak/students/yudisiun') ?>"'>Kembali</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="modal fade" id="modal-delete">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h4 class="modal-title">Hapus Yudisium</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="frmdel">
                                                    <input type="hidden" name="cat_id" id="id_delete" value="">
                                                    <p>Apakah Anda yakin hapus Yudisium?</p>
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
                                                <h4 class="modal-title">Hapus Yudisium</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin hapus Yudisium ini?</p>
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