
<div class="container">
    <div class="container container-fluid">
        <div class="table">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col-sm-1">NO</th>
                    <th scope="col-sm-4">NAMA_MAHASISWA</th>
                    <th scope="col-sm-2">NIM_MAHASISWA</th>
                    <th scope="col-sm-2">TUJUAN MAGANG</th>
                    <th scope="col-sm-2">PROSES MAGANG</th>
                    <th scope="col-sm-3">TANGGAL MHS PENGAJUAN</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                $no = 1;
                    foreach ($magang as $value){?>
                <tr>
                    <td scope="col-sm-1"><?php echo $no++;?></td>
                    <td scope="col-sm-4"><?php echo $value['NAMA_MHS'];?></td>
                    <td scope="col-sm-2"><?php echo $value['NIM_MHS'];?></td>
                    <td scope="col-sm-2"><?php echo $value['NAMA_PERUSAHAAN'];?></td>
                    <td scope="col-sm-2">
                        <?php 
                            if($value['RESPONS']==0){?>
                                <a style="text-decoration:none" href="<?php echo site_url('MHS/prosespengajuan')?>/<?php echo $value['ID_DATA_PKL']?>/<?php echo $value['NAMA_PEGAWAI'];?>/prosespengajuan/<?php echo $value['VALUE_DATA'];?>/<?php echo $value['JENIS_MAGANG'];?>" target="blank"><p class="text text-info text-mute"><button class="btn btn-success">Proses</button></p>
                                </a>
                            <?php }
                            if($value['RESPONS'] == 1){?>
                                <a style="text-decoration:none" href="<?php echo site_url('MHS/uploadberkas')?>/<?php echo $value['ID_MHS_PKL']?>/<?php echo $value['NAMA_PEGAWAI'];?>/prosespengajuan/<?php echo $value['VALUE_DATA'];?>/<?php echo $value['JENIS_MAGANG'];?>">
                                <p class="text text-info text-mute"><button class="alert alert-danger">Upload</button></p></a>
                                <?php }
                            if($value['RESPONS'] == 2){?><p class="alert alert-info">Selesai</p><?php }
                                if($value['RESPONS'] == 3){?><p class="alert alert-warning">Ditolak</p><?php }?></td>
                    <td scope="col-sm-2"><?php echo $value['TANGGAL_MHS_INPUT'];?></td>
                </tr>
                <?php };?>
            </tbody>
            </table>
        </div>
    </div>
</div>