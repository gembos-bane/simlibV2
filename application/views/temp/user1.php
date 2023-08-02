 <?php foreach ($data as $row ){ ?>
 <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
          <div class="container container-fluid">
            <ul class="navbar-nav">
              <li class="nav-item">
                <button type="button" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#Modal2">Update Data</button>
              </li>
            </ul>
          </div>
    </nav>
    <div class="container-fluid col-sm-8 col-xl-9">
             <!-- The Modal1 -->

        <!-- Modal2 -->
        <div class="modal" id="Modal2">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Update Account</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                            <form  action="<?php echo site_url('Source_in_out/updatedata') ?>" method="post" >
                
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-xl-9 mx-auto">
                                        <div class="cta-inner bg-faded rounded">
                                            
                                            <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">NAMA</span>
                                                        <input type="text" class="form-control"  aria-label="Nama" aria-describedby="basic-addon1" name="Nama" value="<?php echo $row ['NAMA_PEGAWAI'];?>">
                                                    </div>
                                                </li>
                                                
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">NIP</span>
                                                        <input type="text" class="form-control"  aria-label="Nip" aria-describedby="basic-addon1" name="Nip" value="<?php echo $row['NIP_PEGAWAI'];?>">
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Pangkat</span>
                                                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="Pangkat" value="<?php echo $row['GOLONGAN'];?>">
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Prodi</span>
                                                        <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="Prodi" value="<?php echo $row['NAMA_PRODI'];?>">
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">NO TLP</span>
                                                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="tlp" value="<?php echo $row['NO_TLP'];?>">
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Email</span>
                                                        <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="email" value="<?php echo $row['E_MAIL'];?>">
                                                    </div>
                                                </li>
                                                                                                
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Alamat</span>
                                                        <input type="text" class="form-control" placeholder="<?php echo $row['ALAMAT'];?>" aria-label="Password" aria-describedby="basic-addon1" name="alamat" value="<?php echo $row['ALAMAT'];?>">
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">TMT</span>
                                                        <input type="date" class="form-control" placeholder="<?php echo $row['TMT'];?>" aria-label="Password" aria-describedby="basic-addon1" name="tanggal" value="<?php echo $row['TMT'];?>">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        

                      <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Submit</button>
                          </div>
                        </form><!-- exit form -->
                      </div>
                    </div>
                  </div>
                </div>
        <!-- end Modal2 --> 
        <!--table data user-->
        
            
        <div>&nbsp;</div>

                <!-- Page content-->
        <div class="container-fluid">
            <p>&nbsp;</p>
                <div class="text-center">
                    <img src="<?php echo base_url()?>assets/img/logo unair.jpg" class="img img-thumbnail border" width='200' high='200'>
                    <div> &nbsp;</div><div> &nbsp;</div>
                </div>
        </div>                    
        <div class="container-fluid col-sm-8 col-lg-8">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col-sm-1">List Data</th>
                        <th scope="col-sm-11">comment data list</th>
                    </tr>
                </thead>
                <tbody class="text-muted">
                    <tr>
                        <th scope="col-sm-1"><p class="text-capitalize">Nama</p></th>
                        <th scope="col-sm-11"><p class="text-capitalize"><?php echo $row ['NAMA_PEGAWAI'];?></p></th>
                        
                    </tr>
                    <tr>
                        <th scope="col-sm-1"><p class="text-capitalize">NIP/NIK</p></th>
                        <th scope="col-sm-11"><p class="text-capitalize"><?php echo $row['NIP_PEGAWAI'];?></p></th>
                        
                    </tr>
                    <tr>
                        <th scope="col-sm-1"><p class="text-capitalize">Pangkat/Golongan</p></th>
                        <th scope="col-sm-11"><p class="text-capitalize"><?php echo $row['GOLONGAN'];?></p></th>
                      
                    </tr>
                    <tr>
                        <th scope="col-sm-1"><p class="text-capitalize">PRODI</p></th>
                        <th scope="col-sm-11"><p class="text-capitalize"><?php echo $row['NAMA_PRODI'];?></p></th>
                    </tr>
                    <tr>
                        <th scope="col-sm-1"><p class="text-capitalize">No Telp</p></th>
                        <th scope="col-sm-11"><p class="text-capitalize"><?php echo $row['NO_TLP'];?></p></th>
                    <tr>
                        <th scope="col-sm-1"><p class="text-capitalize">e-mail</p></th>
                        <th scope="col-sm-11"><p class="text-capitalize"><?php echo $row['E_MAIL'];?></p></th>
                    </tr>
                    <tr>
                        <th scope="col-sm-1"><p class="text-capitalize">TMT</p></th>
                        <th scope="col-sm-11"><p class="text-capitalize"><?php echo $row['TMT'];?></p></th>
                    </tr>
                    <tr>
                        <th scope="col-sm-1"><p class="text-capitalize">alamat</p></th>
                        <th scope="col-sm-11"><p class="text-capitalize"><?php echo $row['ALAMAT'];?></p></th>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- end page content -->
    </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="<?php echo base_url()?>assets/js/script.js"></script>
<script>
    
</script>
</body><?php }?>
</html>
