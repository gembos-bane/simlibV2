<style type="text/css">
    body{
        font-family: sans-serif;
    }
    table{
        margin: 20px auto;
        border-collapse: collapse;
    }
    table th,
    table td{
        border: 1px solid #3c3c3c;
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
    header("Content-Disposition: attachment; filename= ".$judul.".xls");
?>
<center>
    <h4>DAFTAR NAMA MAHASISWA <?php echo $judul;?><br/>PRODI <?php foreach($prodi as $row){echo $row->NAMA_PRODI;}?><br/> FAKULTAS VOKASI UNAIR<br/>GASAL 2023-2024</h4>
</center>
<div class="container">
    <div class="container container-fluid">
        <div class="table">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col-sm-1">NO</th>
                    <th scope="col-sm-4">NAMA_MHS</th>
                    <th scope="col-sm-2">NIM_MHS</th>
                    <th scope="col-sm-2">PEMBIMBING</th>
                    <th scope="col-sm-2">TGL MULAI</th>
                    <th scope="col-sm-3">TGL AKHIR</th>
                    <th scope="col-sm-3">TEMPAT MAGANG</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                $no = 1;
                foreach ($report as $key => $value) {
                    ?>
                <tr>
                    <td scope="col-sm-1"><?php echo $no++;?></td>
                    <td scope="col-sm-4"><?php echo $value['NAMA_MHS'];?></td>
                    <td scope="col-sm-2"><?php echo $value['NIM_MHS'];?></td>
                    <td scope="col-sm-2"><?php echo $value['NAMA_DOSEN'];?></td>
                    <td scope="col-sm-2"><?php echo $value['TGL_MULAI'];?></td>
                    <td scope="col-sm-3"><?php echo $value['TGL_BERAKHIR'];?></td>
                    <td scope="col-sm-3"><?php echo $value['NAMA_PERUSAHAAN'].", ".$value['ALAMAT_PERUSAHAAN'];?></td>
                </tr>
                <?php };?>
            </tbody>
            </table>
        </div>
    </div>
    
</div>