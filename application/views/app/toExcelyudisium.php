<style type="text/css">
    body{
        font-family: sans-serif;
    }
    table{
        margin: 20px auto;
        border-collapse: collapse;
    }
    table, th, td{
        border: 1px ridge; #3c3c3c;
        padding: 3px 8px;
 
    }
    a{
        background: blue;
        color: #fff;
        padding: 8px 10px;
        text-decoration: none;
        border-radius: 2px;
    }
</style>
<?php 
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename= daftar yudisium.xls");
?>
<center>
    <h4>DAFTAR LULUSAN MAHASISWA FAKULTAS VOKASI UNIVERSITAS AIRLANGGA<br/>SEMESTER GASAL TAHUN 2022-2023<br/>PROGRAM STUDI D-IV PERBANKAN DAN KEUANGAN<br/>YUDISIUM TANGGA </h4>
</center>
<div class="container">
    <div class="container container-fluid">
        <div class="table">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col-sm-1">NO</th>
                    <th scope="col-sm-4">NAMA</th>
                    <th scope="col-sm-2">NIM</th>
                    <th scope="col-sm-2">NIK</th>
                    <th scope="col-sm-2">TEMPAT LAHIR</th>
                    <th scope="col-sm-3">TGL_LAHIR</th>
                    <th scope="col-sm-1">NO HP</th>
                    <th scope="col-sm-1">SKS</th>
                    <th scope="col-sm-1">IPK</th>
                    <th scope="col-sm-1">NILAI D%</th>
                    <th scope="col-sm-1">TOEFL</th>
                    <th scope="col-sm-1">SKP</th>
                    <th scope="col-sm-1">PPKMB</th>
                    <th scope="col-sm-1">UKOM</th>
                    <th scope="col-sm-1">KTM</th>
                    <th scope="col-sm-1">BUKTI TA</th>
                    <th scope="col-sm-1">BEBAS PINJAM PERPUS</th>
                    <th scope="col-sm-1">BUKTI LUNAS SP3</th>
                    <th scope="col-sm-1">BUKTI LUNAS SOP</th>
                    <th scope="col-sm-1">BUKTI ARTIKEL</th>
            </thead>
            <tbody>

                <?php 
                $no = 1;
                foreach ($datamhs as $value) {
                    ?>
                <tr class="text-center">
                    <td scope="col-sm-1"><?php echo $no++;?></td>
                    <td scope="col-sm-4"><?php echo $value['NAMA_PEGAWAI'];?></td>
                    <td scope="col-sm-2"><?php echo $value['NIP_PEGAWAI'];?></td>
                    <td scope="col-sm-2"><?php echo $value['NIK'];?></td>
                    <td scope="col-sm-2"><?php echo $value['TEMPAT_LAHIR'];?></td>
                    <td scope="col-sm-3"><?php echo $value['TANGGAL_LAHIR'];?></td>
                    <td scope="col-sm-1"><?php echo $value['NO_HP'];?></td>
                    <td scope="col-sm-1"><?php echo $value['SKS'];?></td>
                    <td scope="col-sm-1"><?php echo $value['IPK'];?></td>
                    <td scope="col-sm-1"><?php echo $value['NILAI_D'];?></td>
                    <td scope="col-sm-1"><?php echo $value['TOEFL'];?></td>
                    <td scope="col-sm-1"><?php echo $value['SKP'];?></td>
                    <td scope="col-sm-1"><?php echo $ket;?></td>
                    <td scope="col-sm-1"><?php echo $ket;?></td>
                    <td scope="col-sm-1"><?php echo $ket;?></td>
                    <td scope="col-sm-1"><?php echo $ket;?></td>
                    <td scope="col-sm-1"><?php echo $ket;?></td>
                    <td scope="col-sm-1"><?php echo $ket;?></td>
                    <td scope="col-sm-1"><?php echo $ket;?></td>
                    <td scope="col-sm-1"><?php echo $ket;?></td>
                    
                </tr>
                <?php };?>
            </tbody>
            </table>
        </div>
    </div>
    
</div>