<!DOCTYPE html>
<html lang="en">

<head>
<style>
    rem {
        font-size: 9px;
        margin-bottom: 1px;
    }
    fak {
        font-size: 110%;
        margin-bottom: 1px;
        font-weight: bold;
    }
    uni {
        font-size: 125%;
        margin-bottom: 1px;
    }
    kop {
        
        text-justify: inter-word;
        font-size: 90%;
        margin-top: 5px;
        margin-bottom: 5px;
        
    }
    isi {
        font-size: 90%;
        margin-top: 40px;
        margin-bottom: 1px;
    }
    ttd{
        font-size: 90%;
        margin-left: 60%;
        margin-bottom: 5px;
    }
    nip {
        font-size: 90%;
        margin-left: 49%;
        margin-bottom: 5px;
    }
    tem {
        font-size: 90%;
        margin-bottom: 5px;
    }
    body.srt{
        margin-left: 7%;
        margin-right: 6%;
    }
    table.isi{
        font-size: 90%;
        margin-bottom: 1px; 
    }
</style>

</head>
<body class="srt">
    <table width="100%">
        <tr>
            <td width="10%"><img  src="<?php echo $_SERVER["DOCUMENT_ROOT"]."/logo_unair.JPG"; ?>" width="10%"/></td>
            <td width="90%"><center><uni>UNIVERSITAS AIRLANGGA</uni></center>
                <center><fak>FAKULTAS VOKASI</fak></center>
                <center ><rem>Kampus C Mulyorejo, Surabaya 60115 Telp. (031)5914042, 5912546, 5912564 Fax (031) 5981841</rem></center>
                <center><rem>website: http://www.unair.ac.id; e-mail: rektor@unair.ac.id</rem></center>
            </td>
        </tr>
    </table><hr> <br>      

<kop>Nomor : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;/UN.FV/I/PK.01.06/2023&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo format_indo(date('Y-m-d')); ?></kop></br>
<kop>Hal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Permohonan Ijin Praktek Kerja Lapangan</kop></br>
<p>&nbsp;</p>
      
<?php foreach($berkas as $row){?>
<isi>Yth. <?php echo $row['NAMA_TUJUAN']; ?></br>
<?php echo $row['NAMA_PERUSAHAAN']; ?></br>
<?php echo $row['ALAMAT_PERUSAHAAN']; ?></br>
<<?php echo $row['KOTA']; ?></isi></br>
    
<p>&nbsp;</p>
&nbsp; 
<kop>Sehubungan dengan kegiatan kurikulum berupa Praktek Kerja Lapangan yang dilaksanakan oleh mahasiswa,maka kami mohon kesediaan Bapak/Ibu untuk mengijinkan mahaiswa Fakultas Vokasi universitas Airlangga,Semester Gasal Tahun Akademik 2023/2024 Program Studi <?php echo $_SESSION['prodi']; ?>, untuk melaksanakan PKL di <?php echo $row['NAMA_PERUSAHAAN'] ;?> Adapun Mahasiswa yang akan melaksanakan PKL sebagai berikut :</kop></br>
&nbsp;

<table border="1" cellspacing="0" cellpadding="2" width="100%" class="isi">
              
    <tr class="text-center">
        <th scope="col-sm-1">No</th>
        <th scope="col-sm-4">Nama</th>
        <th scope="col-sm-2">Nim</th>
        <th scope="col-sm-2">Alamat</th>
        <th scope="col-sm-3">Telp</th>
    </tr>
    <?php $a=1; ?>
    <tr>
        <td class="text-center"><?php echo $a++;?></td>
        <td><?php echo $row['NAMA_MHS'];?></td>
        <td><center><?php echo $row['NIM_MHS']?></center></td>
        <td><?php echo $row['ALAMAT_MHS'];?></td>
        <td class="text-center"><?php echo $row['NO_TLP_MHS'];?></td>
    </tr>
</table></br>

               <kop>Waktu Pelaksanaan PKL Tersebut direncanakan Mulai Tanggal <?php echo $row['TGL_MULAI'] ;?> Sampai dengan <?php echo $row['TGL_BERAKHIR']; ?>.</br>Mohon konfirmasi surat balasan PKL dari Perusahaan yang Bapak / Ibu Pimpin ke alamat Email Prodi: <?php echo $row['EMAIL_TLP'];?>.</br>Demikian atas perhatian dan kerjasama yang baik, kami sampaikan terima kasih.</kop>
<p>&nbsp;</p>

<ttd>a.n. Dekan</ttd></br>
<ttd>Wakil Dekan I</ttd></br>
<ttd>&nbsp;</ttd>
<ttd>&nbsp;</ttd>

<ttd>Dr. Tika Widiastuti, S.E.,M.Si</ttd></br>
<tem>Tembusan :</tem><nip>NIP 198312302008122001</nip></br>

<tem>1. Ketua Departemen Bisnis</br>2. Ketua Kordinator Program Studi D-II Manajemen Pemasaran</br>Fakultas Vokasi</tem>
       
<?php }?>

</body>