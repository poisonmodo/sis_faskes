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
                    <h1 class="m-0 text-dark">Laporan Ijazah</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Export</li>
                        <li class="breadcrumb-item">Laporan Ijazah</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form method="post" action="<?php echo site_url('export/xls/ijazah') ?>" id="frmsearch">
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
                                        <div lass="form-group">
                                            <label for="jurusan">No Ijazah</label>
                                            <input type="text" name="no_ijazah" id="no_ijazah" class="form-control" value="<?php echo $no_ijazah ?>" /> 
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
                                        <div lass="form-group">
                                            <label for="thn_lulus">Tahun Lulus Yudisium</label>
                                            <input type="text" name="thn_lulus" id="thn_lulus" class="form-control" value="<?php echo $thn_lulus ?>" /> 
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
                                <h3 class="card-title">Laporan Ijazah</h3>
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
                                        <!-- <button type="submit" class="btn btn-primary" name="exportbtn" id="exportbtn1" value="export">Export XLS</button> -->
                                        <button type="submit" class="btn btn-primary" name="exportbtn2" id="exportbtn3" value="export">Export PDF</button>
                                    </div>
                                </div>
                                <table id="example1" class="table table-bordered table-hovered">
                                    <thead>
                                        <tr>
                                            <th >NO</th>
                                            <th >NIM Mahasiswa</th>
                                            <th >Nama Mahasiswa</th>
                                            <th >Jurusan</th>
                                            <th >Tanggal Yudisium</th>
                                            <th >Tahun Akademik</th>
                                            <th >Tanggal Ijazah</th>
                                            <th >No Ijazah</th>
                                            <th >Foto Ijazah</th>
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
                                            <td><?php echo $student->jurusan ?></td>
                                            <td><?php echo $student->tanggal_yudisium ?></td>
                                            <td><?php echo $student->tahun_akademik ?></td>
                                            <td><?php echo $student->tanggal_ijazah ?></td>
                                            <td><?php echo $student->no_ijazah ?></td>
                                            <td>
                        <?php   $path=FCPATH."/images/ijazah";
                                $imgpath = $path."/".$student->nim; 
                                $imgurl = site_url("images/ijazah/".$student->nim."/".$student->filename);      
                                if(file_exists($imgpath."/".$student->filename)) { ?>
                                                <img src="<?php echo $imgurl ?>" width="125px" /><br>    
                        <?php   }  ?>                                   
                                            </td>
                                            
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
                                        <th >Jenis Kelamin</th>
                                        <th >Jurusan</th>
                                        <th >Tahun Akademik</th>
                                        <th >no ijazah</th> 
                                        <th >Tanggal Yudisium</th>   
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- <button type="submit" class="btn btn-primary" name="exportbtn" id="exportbtn2" value="export">Export XLS</button> -->
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