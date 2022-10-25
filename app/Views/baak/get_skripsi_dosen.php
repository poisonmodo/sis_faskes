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
                        <li class="breadcrumb-item">Skripsi</li>
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
<?php if(strlen($infoskripsi->judul_skripsi)>19) {      
        $ket=substr($infoskripsi->judul_skripsi,0,20)."...";
      }
      else {
        $ket = $infoskripsi->judul_skripsi;
      }   
?>                         
                              
                            <h3 class="card-title">Dosen Skripsi <?php echo $ket; ?></h3>
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
                                <form method="post" action="<?php echo site_url('baak/skripsi/dosen/'.$skripsi_id) ?>" id="frmlist">
                                    <input type="hidden" name="delall" id="delall" value="1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary" name="addbtn" id="addbtn1" onclick='location.href="<?php echo site_url('baak/skripsi/dosen/add/'.$skripsi_id) ?>"'>Tambah Dosen</button>
                                            <button type="submit" class="btn btn-danger delallbtn" name="delallbtn" id="delallbtn1" value="del">Hapus Skripsi</button>
                                            <button type="button" class="btn btn-danger" name="backbtn" id="backbtn1" value="back" onclick='location.href="<?php echo site_url('baak/skripsi') ?>"'>Kembali</button>
                                        </div>
                                    </div>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-1">
                                                    <input type="checkbox" id="chkall1" class="chkall" value="1">
                                                </th>
                                                <th class="col-sm-5">NIK</th>
                                                <th class="col-sm-5">Nama Dosen</th>
                                                <th class="col-sm-5">Posisi</th>
                                                <th class="col-sm-1">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php if ($dosenlist) {
                                                $i=1;
                                                
                                                // $generator = new Barcode\BarcodeGeneratorHTML();
                                                foreach ($dosenlist as $dosen) : 
                                                    switch($dosen->posisi) {
                                                        case 1:
                                                            $ket="Pembimbing";
                                                        break;
                                                        case 2:
                                                            $ket="Penguji I";
                                                        break;
                                                        case 3:
                                                            $ket="Penguji II";
                                                        break;    
                                                    }
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="chkbox[]" id="chkbox<?php echo $i ?>" class="chkbox" value="<?php echo $dosen->id ?>">
                                                        </td>
                                                        <td>
                                                            <?php echo $dosen->nik ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $dosen->nama_dosen ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $ket ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo site_url('baak/skripsi/dosen/edit/'.$skripsi_id.'/'.$dosen->id) ?>" data-toggle="tooltip" title="Edit Dosen"><i class="fa fa-edit"></i></a>
                                                            <a href="#"  title="Hapus Dosen" id="<?php echo $dosen->id ?>" class="delbtn" onclick="return false;"><i class="fa fa-minus-square"></i></a>    
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
											<th>Judul Skripsi</th>
											<th>Nama Dosen</th>
                                            <th>Posisi</th>
											<th>Aksi</th>
                                        </tfoot>
                                    </table>    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary" name="addbtn2" id="addbtn2" onclick='location.href="<?php echo site_url('baak/skripsi/dosen/add/'.$skripsi_id) ?>"'>Tambah Dosen</button>
                                            <button type="submit" class="btn btn-danger delallbtn" name="delallbtn" id="delallbtn2" value="del">Hapus Dosen</button>
                                            <button type="button" class="btn btn-danger" name="backbtn" id="backbtn2" value="back" onclick='location.href="<?php echo site_url('baak/skripsi') ?>"'>Kembali</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="modal fade" id="modal-delete">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h4 class="modal-title">Hapus Skripsi</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="frmdel">
                                                    <input type="hidden" name="cat_id" id="id_delete" value="">
                                                    <p>Apakah Anda yakin hapus Dosen?</p>
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
                                                <h4 class="modal-title">Hapus Skripsi</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin hapus Dosen ini?</p>
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