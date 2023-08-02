
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url()?>Passing/profile/Profile#!<?php echo hash('sha256',$_SESSION['user'])?>" >
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $_SESSION['user'];?> <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url()?>Passing/Profile/profile#!<?php echo hash('sha256',$_SESSION['user'])?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Berkas Akademik</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">AKADEMIK</h6>
                        <a class="collapse-item" href="<?php echo base_url()?>Passing/profile/search#!<?php echo hash('sha256',$_SESSION['user'])?>">SK AKADEMIK</a>
                        <a class="collapse-item" href="<?php echo base_url()?>Passing/BerkasAll/outallberkas/outallberkas#!<?php echo hash('sha256',$_SESSION['user'])?>">ALL BERKAS</a>
                        <a class="collapse-item" href="<?php echo base_url()?>Passing/profile/persuratan/suratprodi#!<?php echo hash('sha256',$_SESSION['user'])?>">PERSURATAN</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Berkas Akreditasi</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Akreditasi</h6>
                        <a class="collapse-item" href="<?php echo site_url('Akreditasi/index')?>/<?php echo $_SESSION['idpegawai'];?>/search#!<?php echo hash('sha256',$_SESSION['user'])?>">Borang Akreditasi</a>
                        <a class="collapse-item" href="<?php echo site_url('Akreditasi/buktiborang')?>/<?php echo $_SESSION['idpegawai'];?>/search#!<?php echo hash('sha256',$_SESSION['user'])?>">Bukti Borang</a>
                        <a class="collapse-item" href="<?php echo base_url()?>Passing/profile/persuratan/suratprodi#!<?php echo hash('sha256',$_SESSION['user'])?>">Arsip Surat</a>
                        <a class="collapse-item" href="<?php echo base_url()?>Passing/profile/persuratan/suratprodi#!<?php echo hash('sha256',$_SESSION['user'])?>">Berkas Pendukung</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-flag"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url();?>Backbone/editprofile">EDIT PROFILE</a>
                        <a class="collapse-item" href="<?php echo base_url();?>Backbone/LogOut">LOGOUT</a>
                        
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            

        </ul>
        <!-- End of Sidebar -->
