<?php
$session = session();
$sess = $session->get('security');    
//$group_id = $sess["group_id"];
?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
<?php //if($group_id<3) { ?>         
        <li class="nav-item menu-open">
            <a href="<?php echo site_url('home') ?>" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>    
        </li>    
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-inbox"></i>
                <p>
                    Master
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo site_url('master/city') ?>" class="nav-link">
                        <i class="fa fa-user-graduate nav-icon"></i>
                        <p>Kota</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('master/province') ?>" class="nav-link">
                        <i class="fa fa-handshake nav-icon"></i>
                        <p>Provinsi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('master/vaksin') ?>" class="nav-link">
                        <i class="fa fa-handshake nav-icon"></i>
                        <p>Vaksin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('master/faskes') ?>" class="nav-link">
                        <i class="fa fa-handshake nav-icon"></i>
                        <p>Faskes</p>
                    </a>
                </li>
            </ul>
        </li>
        <!-- <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-laptop"></i>
                <p>
                    BAAK
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo site_url('baak/students/yudisium') ?>" class="nav-link">
                        <i class="fa fa-newspaper nav-icon"></i>
                        <p>Yudisium</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('baak/students/ijazah') ?>" class="nav-link">
                        <i class="far fa-building nav-icon"></i>
                        <p>Ijazah</p>
                    </a>
                </li>
            </ul>
        </li> -->
<?php //} ?>          
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-file-export"></i>
                <p>
                    Laporan
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo site_url('export/xls/students') ?>" class="nav-link">
                        <i class="fa fa-id-card nav-icon"></i>
                        <p>Mahasiswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('export/xls/ijazah') ?>" class="nav-link">
                        <i class="fa fa-id-card nav-icon"></i>
                        <p>Ijazah</p>
                    </a>
                </li>
            </ul>
        </li>
<?php //if($group_id==1) { ?>        
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-toolbox"></i>
                <p>
                    Management
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo site_url('management/user') ?>" class="nav-link">
                        <i class="far fa-user nav-icon"></i>
                        <p>User</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="<?php echo site_url('management/Settings') ?>" class="nav-link">
                        <i class="far fa-building nav-icon"></i>
                        <p>Koreksi</p>
                    </a>
                </li> -->
            </ul>
        </li>
<?php //} ?>        
    </ul>
</nav>