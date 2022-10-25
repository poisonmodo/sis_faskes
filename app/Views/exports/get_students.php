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
                    <h1 class="m-0 text-dark">Laporan Mahasiswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Export</li>
                        <li class="breadcrumb-item">Laporan Mahasiswa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form method="post" action="<?php echo site_url('export/xls/students') ?>" id="frmsearch">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                            <div class="card-title">Search</div>
                            </div>
                            <div class="card-body">
                     
                                <div class="row">
                                    <div class="col-md-6">
                                        <div lass="form-group">
                                            <label for="jurusan">NIM</label>
                                            <input type="text" name="nim" id="nim" class="form-control" value="<?php echo $nim ?>" /> 
                                        </div>
                                        <div lass="form-group">
                                            <label for="jurusan">Jurusan</label>
                                            <select name="jurusan" class="form-control">
                                                <option>Semua Jurusan</option>
                        <?php if($jurusanlist) { 
                                foreach($jurusanlist as $jurusan) {   ?>
                                                <option value="<?php echo $jurusan->id ?>" <?php echo ($jurusan->id==$jurusan_id)?"selected='selected'":"" ?>><?php echo $jurusan->jurusan ?></option>    
                        <?php   }
                              } ?>                             
                                            </select>
                                        </div>
                                    </div>         
                
                                    <div class="col-md-6">
                                        <div lass="form-group">
                                            <label for="jurusan">Nama</label>
                                            <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $nama ?>" /> 
                                        </div>
                                        <div lass="form-group">
                                            <label for="thn_ajaran">Tahun Akademik</label>
                                            <select name="thn_ajaran" id="thn_ajaran" class="form-control">
                                                <option value="">Semua Tahun Akademik</option>
                        <?php if($tahunlist) { 
                                foreach($tahunlist as $tahun) {   ?>
                                                <option value="<?php echo $tahun->tahun_akademik ?>" <?php echo ($tahun->tahun_akademik==$tahun_ajaran)?"selected='selected'":"" ?>><?php echo $tahun ->tahun_akademik ?></option>    
                        <?php   }
                              } ?>                             
                                            </select>
                                        </div>   
                                    </div>  
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div lass="form-group">
                                            <button class="btn btn-primary" type="submit" name="searchbtn" id="searchbtn" value="Cari">Cari</button>  
                                        </div>
                                    </div>    
                                </div>
                            </div>    
                        </div>
                    </div>    
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Laporan Mahasiswa</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" name="exportbtn" id="exportbtn1" value="export">Export XLS</button>
                                        <button type="submit" class="btn btn-primary" name="exportbtn2" id="exportbtn3" value="export">Export PDF</button>
                                    </div>
                                </div>
                                <table id="example1" class="table table-bordered table-hovered">
                                    <thead>
                                        <tr>
                                            <th >NO</th>
                                            <th >NIM Mahasiswa</th>
                                            <th >Nama Mahasiswa</th>
                                            <th >Tempat/Tanggal Lahir</th>
                                            <th >Jenis Kelamin</th>
                                            <th >No KTP</th>
                                            <th >Jurusan</th>
                                            <th >Tahun Akademik</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php if ($studentlist) {
                                            $i=1;
                                            // $generator = new Barcode\BarcodeGeneratorHTML();
                                            foreach ($studentlist as $student) : ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $student->nim ?></td>
                                            <td><?php echo $student->nama_lengkap ?></td>
                                            <td>
                                            <?php if($student->tempat_lahir && $student->tgl_lahir) { 
                                                    echo $student->tempat_lahir.", ".date("d F Y",strtotime($student->tgl_lahir));  
                                                    }
                                                    
                                            ?>
                                            </td>   
                                            <td>
                                            <?php if($student->jenis_kelamin=="1") {
                                                    echo "Pria";
                                                    }    
                                                    if($student->jenis_kelamin=="2") {
                                                    echo "Wanita";
                                                    }    
                                            ?>
                                            </td>   
                                            <td><?php echo $student->no_identitas ?></td>
                                            <td><?php echo $student->jurusan ?></td>
                                            <td><?php echo $student->tahun_akademik ?></td>
                                        </tr>
                                <?php 
                                                $i++;    
                                            endforeach; 
                                        }
                                        else {  ?>
                                        <tr>
                                            <td colspan="10" class="text-center">Data tidak ditemukan</td>
                                            
                                        </tr>
                                <?php } ?>      
                                    </tbody>
                                    <tfoot>
                                        <th>No</th>
                                        <th >NIM Mahasiswa</th>
                                        <th >Nama Mahasiswa</th>
                                        <th >Tempat/Tanggal Lahir</th>
                                        <th >Jenis Kelamin</th>
                                        <th >No KTP</th>
                                        <th >Jurusan</th>
                                        <th >Tahun Akademik</th>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" name="exportbtn" id="exportbtn2" value="export">Export XLS</button>
                                        <button type="submit" class="btn btn-primary" name="exportbtn2" id="exportbtn4" value="export">Export PDF</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->

            </form>
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