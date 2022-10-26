<?php echo view('includes/header') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
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
        <!-- small box -->
        <div class="col-lg-6">
          <!--- faskes //-->
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="col-sm-1">
                        #
                </th>
                <th class="col-sm-10">Tipe Faskes</th>
                <th class="col-sm-1">Total</th>
              </tr>
            </thead>
            <tbody>
        <?php if ($faskes_count) {
                    $i=1;
                    // $generator = new Barcode\BarcodeGeneratorHTML();
                    foreach ($faskes_count as $faskes) : 
                      switch($faskes->faskes_type) {
                        case 1: //Puskesmas
                            $ket="Puskesmas";
                        break;
                        case 2: //Rumah Sakit
                            $ket="Rumah Sakit";
                        break;
                        case 3: //Puskesmas
                            $ket="Klinik";
                        break;    
                    }?>
                    
              <tr>
                <td  class="text-right"s>
                  <?php echo $i ?>
                </td>
                <td>
                  <?php echo $ket ?>
                </td>
                <td  class="text-right">
                  <?php echo $faskes->jml ?>
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
            
          </table>
        </div>
        <!--- vaksin //-->        
        <div class="col-lg-6">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="col-sm-1">
                        #
                </th>
                <th class="col-sm-10">Vaksin</th>
                <th class="col-sm-1">Total</th>
              </tr>
            </thead>
            <tbody>
        <?php if ($vaksin_count) {
                    $i=1;
                    // $generator = new Barcode\BarcodeGeneratorHTML();
                    foreach ($vaksin_count as $vaksin) : ?>
                    
              <tr>
                <td  class="text-right">
                  <?php echo $i ?>
                </td>
                <td>
                  <?php echo $vaksin->vaksin_name ?>
                </td>
                <td class="text-right">
                  <?php echo $vaksin->jml ?>
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
            
          </table>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<?php echo view('includes/footer') ?>