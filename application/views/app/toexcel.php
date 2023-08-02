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
    header("Content-Disposition: attachment; filename= Report arsip.xls");
?>
<center>
    <h4>Report data Arsip SK Akademeik <br/>Fakultas Vokasi <br/> UNAIR</h4>
</center>
<div class="container">
    <div class="container container-fluid">
        <div class="table">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col-sm-1">NO</th>
                    <th scope="col-sm-4">NAMA_ARSIP</th>
                    <th scope="col-sm-2">TAHUN SK</th>
                    <th scope="col-sm-2">SEMESTER</th>
                    <th scope="col-sm-2">NAMA FILE</th>
                    <th scope="col-sm-3">Uploader</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                $no = 1;
                foreach ($report as $key => $value) {
                    ?>
                <tr>
                    <td scope="col-sm-1"><?php echo $no++;?></td>
                    <td scope="col-sm-4"><?php echo $value['JENIS_SK'];?></td>
                    <td scope="col-sm-2"><?php echo $value['TAHUN_AKD'];?></td>
                    <td scope="col-sm-2"><?php echo $value['SEMESTER'];?></td>
                    <td scope="col-sm-2"><?php echo $value['LOKASI_BERKAS'];?></td>
                    <td scope="col-sm-3"><?php echo $value['NAMA_PRODI'];?></td>
                </tr>
                <?php };?>
            </tbody>
            </table>
        </div>
    </div>
    
</div>