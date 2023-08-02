
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        
        <div class="collapse navbar-collapse active" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <h2>Report Pengajuan Berkas Magang/PKL</h2>
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
                    <td scope="col-sm-4"><?php echo $value['NAMA_TUJUAN'].', '.$value['NAMA_PERUSAHAAN'];?></td>
                    <td scope="col-sm-2"><?php echo $value['ALAMAT_PERUSAHAAN'].', '.$value['KOTA'];?></td>
                    <td scope="col-sm-2"><?php echo $value['EMAIL_TLP'];?></td>
                    <td scope="col-sm-3">
                        <?php if($value['RESPONS'] == 0){ ?>
                            <a href="#" target="blank"><button class="btn btn-danger" >Terproses</button></a>
                            <?php }else{ ?>
                                <a href="#" target="blank"><button class="btn btn-success" >Cetak</button></a> <?php }?>
                        </td>
                </tr>
                <?php };?>
            </tbody>
            </table>
        </div>
    </div>
    
</div>