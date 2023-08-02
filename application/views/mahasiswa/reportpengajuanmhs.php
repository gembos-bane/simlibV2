<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        
        <div class="collapse navbar-collapse active" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <h4>Report Pengajuan Berkas Magang/PKL</h4>
            </li>
          </ul>
        </div>
    </div>
</nav>




<div class="container">
    <div class="container container-fluid">
        <div class="table">
            <table class="table table-bordered">
            <thead class="table alert-info" style="color:darkblue;">
                <tr class="text-center">
                    <th scope="col-sm-1">N0</th>
                    <th scope="col-sm-4">Nama MHS</th>
                    <th scope="col-sm-4">NIM</th>
                    <th scope="col-sm-4">Tujuan</th>
                    <th scope="col-sm-2">Alamat</th>
                    <th scope="col-sm-2">Confirm</th>
                    <th scope="col-sm-3">Status</th>
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
                    <td scope="col-sm-4"><?php echo $value['NIM_MHS'];?></td>
                    <td scope="col-sm-4"><?php echo $value['NAMA_TUJUAN'].', '.$value['NAMA_PERUSAHAAN'];?></td>
                    <td scope="col-sm-2"><?php echo $value['ALAMAT_PERUSAHAAN'].', '.$value['KOTA'];?></td>
                    <td scope="col-sm-2"><?php echo $value['EMAIL_TLP'];?></td>
                    <td scope="col-sm-3">
                        <a href="<?php echo site_url('MHS/prosespengajuan')?>/<?php echo $value['ID_DATA_PKL']?>/<?php echo $value['NAMA_MHS'];?>/<?php echo hash('sha256',$value['NIM_MHS']);?>" target="blank"><button class="btn btn-danger" >Proses</button></a>
                        </td>
                </tr>
                <?php };?>
            </tbody>
            </table>
        </div>
    </div>
    
</div>