
<div class="content">
    <div class="card">
        <div class="card-body">
            <a style='text-decoration: none;' href="<?php echo site_url('API/printexcel');?>" target="blank"><button class="btn btn-info"><i class="fa fa-file-excel-o" aria-hidden="true"> </i>&nbsp;<text class='text text-white'>Report in Excel</text></button></a>
        </div>
    </div>
</div>
<div class="container">
    <div class="container container-fluid">
        <div class="table">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col-sm-1">NO</th>
                    <th scope="col-sm-4">NAMA_ARSIP</th>
                    <th scope="col-sm-2">TAHUN SK</th>
                    <th scope="col-sm-2">SEMESTER</th>
                    <th scope="col-sm-3">ACTION</th>
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
                    <td scope="col-sm-3">
                            <a href="<?php echo site_url('Passing/showall') ?>/skmengajar/<?php echo $value['LOKASI_BERKAS'];?>/<?php echo $value['TYPE_FILE'];?>/<?php echo $value['ID_JENIS_SK'];?> " target="blank"><button class="btn btn-info" >Berkas</button></a>
                            
                        </td>
                </tr>
                <?php };?>
            </tbody>
            </table>
        </div>
    </div>
    
</div>