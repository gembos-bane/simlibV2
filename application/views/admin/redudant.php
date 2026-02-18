<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        
        <div class="collapse navbar-collapse active" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <h4>Report Redudant Data Mhs</h4>
            </li>
          </ul>
        
        </div>
    </div>
</nav>
<form class="form-horizontal" method="post" action="<?php echo site_url('Admin/delredudant');?>"> 
<div class="card">
    <div class="card-body">
        <div class="table">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="table alert-secondary" style="color:darkblue;">
                <tr class="text-center">
                    <th scope="col-sm-1">N0</th>
                    <th scope="col-sm-3">Nama Mahasiswa</th>
                    <th scope="col-sm-2">Tujuan</th>
                    <th scope="col-sm-2">Alamat</th>
                    <th scope="col-sm-1">TGL_Pengajuan</th>
                    <th scope="col-sm-1">Prodi</th>
                    <th scope="col-sm-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value=" " id="Allcheck">
                                <label class="form-check-label" for="flexCheckChecked">All
                                </label>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>

                <?php 
                $no = 1;
                foreach ($redu as $key => $value) {
                    ?>
                <tr>
                    <td scope="col-sm-1"><?php echo $no++;?></td>
                    <td scope="col-sm-3"><?php echo $value['NAMA_MHS'];?></td>
                    <td scope="col-sm-2"><?php echo $value['NAMA_TUJUAN'].', '.$value['NAMA_PERUSAHAAN'];?></td>
                    <td scope="col-sm-2"><?php echo $value['ALAMAT_PERUSAHAAN'].', '.$value['KOTA'];?></td>
                    <td scope="col-sm-1"><?php echo $value['TANGGAL_MHS_INPUT'];?></td>
                    <td scope="col-sm-1"><?php echo $value['NAMA_PRODI'];?></td>
                    <td scope="col-sm-1">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="<?php echo $value['ID_MHS_PKL'];?>" name="check[]" id="check[]">
                              <label class="form-check-label" for="flexCheckChecked">
                                Checked
                              </label>
                            </div>
                        </td>
                </tr>

                <?php };?>
            </tbody>
            <footer>
                 <tr class="text-center">
                    <th colspan="6"></th>
                    <th><button type="submit" class="btn btn-danger">Hapus</button></th>
                </tr>
            </footer>
            </table>

        </div>
    </div>
</div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    $("#Allcheck").click(function(){
        $("input[type=checkbox]").prop('checked',$(this).prop('checked'));
    });
</script>