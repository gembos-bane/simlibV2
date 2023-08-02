
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
                <a class="nav-link" href="<?php echo base_url()?>Passing/profile/Profile#!<?php echo hash('sha256',$_SESSION['user'])?>">
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
                    <span>Pengajuan Akademik</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">PENGAJUAN AKADEMIK</h6>
                        <a class="collapse-item" href="<?php echo base_url()?>MHS/reportpengajuan/0/search#!<?php echo hash('sha256',$_SESSION['user'])?>">Pengajuan Magang / PKL</a>
                        <a class="collapse-item" href="<?php echo base_url()?>Passing/datakemahasiswaan/kemahasiswaan/kemahasiswaan#!<?php echo hash('sha256',$_SESSION['user'])?>">Kemahasiswaan</a>
                        <a class="collapse-item" href="<?php echo base_url()?>Passing/profile/persuratan/persuratan#!<?php echo hash('sha256',$_SESSION['user'])?>">Persuratan</a>
                    </div>
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Report Pengajuan MHS</h6>
                        <a class="collapse-item" href="<?php echo base_url()?>MHS/reportpengajuan/1/search#!<?php echo hash('sha256',$_SESSION['user'])?>">MAGANG/PKL</a>
                        
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAkademik"
                    aria-expanded="true" aria-controls="collapseAkademik">
                    <i class="fas fa-fw fa-flag"></i>
                    <span>SK AKADEMIK</span>
                </a>
                <div id="collapseAkademik" class="collapse" aria-labelledby="headingAkademik"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <?php for($a=0;$a<Count($head);$a++){ ?>
                        <a class="collapse-item" aria-current="page" href="<?php echo base_url()?>Passing/profile/berkasFakultas/<?php echo $head[$a]; ?>/<?php echo $a+1;?>/profile#!<?php echo hash('sha256',$_SESSION['user'])?>"><?php echo $head[$a]; ?></a>
                        <?php } ;?>
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
                        <a class="collapse-item" href="<?php echo base_url();?>API/reportarsip">Report Arsip</a>
                        <a class="collapse-item" href="<?php echo base_url();?>Backbone/editprofile">Edit Profile</a>
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
