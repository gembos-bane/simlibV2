<div class="container">
    <div class="content" style="text-decoration: none;">
        <div class="row">
            <div class="col-sm-1">
                    <img class="rounded" src="<?php echo base_url()?>/assets/img/logo unair.jpg" width="150"/>
            </div>
            <div class="col-sm-10">
                
                    <p class="text-center">
                        <center><h4>KEMENTRIAN RISET, TEKNOLOGI DAN PENDIDIKAN TINGGI</h4></center>
                        <center><h2 class="fw-bolder">UNIVERSITAS AIRLANGGA</h2></center>
                        <center><h6>Kampus C Mulyorejo, Surabaya 60115 Telp. (031)5914042, 5912546, 5912564 Fax (031) 5981841</h6></center>
                        <center><h6>website: http://www.unair.ac.id; e-mail: rektor@unair.ac.id</h6></center>
                    </p>
            </div>
        </div>
    </div>
    <div><hr class="fw-bolder mt-2 mb-2 "/></div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-1">
            <p>&nbsp;</p>
        </div>
        <div class="col-sm-1">
            <p>Nomor</p>
        </div>
        <div class="col-sm-5">
            <p>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/UN.FV/I/PK.01.06/2023</p>
        </div>
        <div class="col-sm-2">
            &nbsp;
        </div>
        <div class="col-sm-2">
            <p>Surabaya, <?php echo date('d-m-Y'); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
            <p>&nbsp;</p>
        </div>
        <div class="col-sm-1">
            <p>Hal</p>
        </div>
        <div class="col-sm-8">
            <p>: Permohonan Ijin Praktek Kerja Lapangan</p>
        </div>
        
    </div>
</div>
<div class="container">&nbsp;</div>
<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-sm-1">
                <p>&nbsp;</p>
            </div>
            <?php foreach($berkas as $row){?>
            <div class="col-sm-4">
                <p class="mb-1">Yth. <?php echo $row['NAMA_TUJUAN']; ?></p>
                <p class="mb-1"><?php echo $row['NAMA_PERUSAHAAN']; ?></p>
                <p class="mb-1"><?php echo $row['ALAMAT_PERUSAHAAN']; ?></p>
                <p class="mb-1"><?php echo $row['KOTA']; ?></p>
            </div>
        
        </div>
    </div>
</div>
<div class="container">&nbsp;</div>
<div class="container">&nbsp;</div>
<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-sm-1">
                <p>&nbsp;</p>
            </div>
            <div class="col-sm-10">
            <p>Sehubungan dengan kegiatan kurikulum berupa Praktek Kerja Lapangan yang dilaksanakan oleh mahasiswa, maka kami mohon kesediaan Bapak/Ibu untuk mengijinkan mahaiswa Fakultas Vokasi universitas Airlangga, Semester Gasal Tahun Akademik 2023/2024 Program Studi <?php echo $_SESSION['prodi']; ?>, untuk melaksanakan PKL di <?php $row['NAMA_PERUSAHAAN'] ;?> Adapun Mahasisea yang akan melaksanakan PKL sebagai berikut :</p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-sm-1">&nbsp;</div>
            <div class="col-sm-10">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col-sm-1">N0</th>
                            <th scope="col-sm-4">NAMA</th>
                            <th scope="col-sm-2">NIM</th>
                            <th scope="col-sm-2">Alamat</th>
                            <th scope="col-sm-3">Telp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $a=1; ?>
                        <tr>
                            <td class="text-center"><?php echo $a++;?></td>
                            <td><?php echo $row['NAMA_MHS'];?></td>
                            <td class="text-center"><?php echo $row['NIM_MHS']?></td>
                            <td><?php echo $row['ALAMAT_MHS'];?></td>
                            <td class="text-center"><?php echo $row['NO_TLP_MHS'];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="content">
        <div class="row">
           <div class="col-sm-1">&nbsp;</div> 
           <div class="col-sm-10">
               <p>Waktu Pelaksanaan PKL Tersebut direncanakan Mulai Tanggal <?php echo $row['TGL_MULAI'] ;?> Sampai dengan <?php echo $row['TGL_BERAKHIR']; ?>.</br>Mohon konfirmasi surat balasan PKL dari Perusahaan yang Bapak / Ibu Pimpin ke alamat Email Prodi: <?php echo $row['EMAIL_TLP'];?>.</p>

           </div> 
        </div>
    </div>
</div>
<div class="container">
    <div class="content">
        <div class="row">
           <div class="col-sm-1">&nbsp;</div> 
           <div class="col-sm-10">
               <p>Demikian atas perhatian dan kerjasama yang baik, kami sampaikan terima kasih.</p>
               
           </div> 
        </div>
    </div>
</div>
<div class="container">
    <div class="row p-2">
        <div class="col-sm-7">
            <p>&nbsp;</p>
        </div>
        <div class="col-sm-5">
            <p>a.n. Dekan</br>Wakil Dekan I</p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
            <p>&nbsp;</p>
        </div>
        <div class="col-sm-1">
            <p>&nbsp;</p>
        </div>
        <div class="col-sm-1">
            <p>&nbsp;</p>
        </div>
        <div class="col-sm-2">
            <p>&nbsp;</p>
        </div>
        <div class="col-sm-4">
            &nbsp;
        </div>
        <div class="col-sm-2">
            <p>&nbsp;</p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <p>&nbsp;</p>
        </div>
        
        <div class="col-sm-5">
            <p>Dr. Tika Widiastuti, S.E.,M.Si</br>NIP 198312302008122001</p>
        </div>
    </div>
</div>
<div class="container">
    <div class="content">
        <div class="row">
           <div class="col-sm-1">&nbsp;</div> 
           <div class="col-sm-10">
               <p>Tembusan :</p>
               <p>1. Ketua Departemen Bisnis</br>2. Ketua Kordinator Program Studi D-II Manajemen Pemasaran</br>Fakultas Vokasi</p>
           </div> 
        </div>
    </div>
</div>

<div class="container">
    <div class="content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    
                    <div class="collapse navbar-collapse active" id="navbarNav">
                      <ul class="navbar-nav">
                        <li class="nav-item">
                          <a class="nav-link" aria-current="page" href="<?php echo site_url('MHS/prosespdf');?>/<?php echo $row['ID_DATA_PKL']?>/<?php echo $row['NAMA_MHS'];?>/prosespdf"><button class="btn btn-info">Create PDF</button></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" aria-current="page" href="<?php echo site_url('Admin/useractivity')?>"><button class="btn btn-danger">Revisi</button></a>
                        </li>
                      </ul>
                    </div>
                </div>
            </nav>
    </div>
</div>
<?php }?>