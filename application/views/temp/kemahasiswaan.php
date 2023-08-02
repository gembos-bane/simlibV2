
<?php foreach ($data as $row ){?>
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
          <div class="container container-fluid">
            <ul class="navbar-nav">
              <li class="nav-item">
                <button type="button" class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#Modal2">UPDATE KEMAHASISWAAN</button>
              </li>
            </ul>
          </div>
    </nav>
    <div class="container-fluid col-sm-8 col-xl-11">
             <!-- The Modal1 -->

        <!-- Modal2 -->
        <div class="modal" id="Modal2">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Update Kemahasiswaan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                           <?php echo form_open_multipart('source_in_out/insertkemahasiswaan')?>
                
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-xl-9 mx-auto">
                                        <div class="cta-inner bg-faded rounded">
                                            <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <div class="input-group mb-3">
                                                           
                                                            <input type="hidden" class="form-control" aria-label="Nama" aria-describedby="basic-addon1" name="idpegawai" value="<?php echo $row['ID_PEGAWAI']?>" >
                                                        </div>
                                                    </li>
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <div class="input-group mb-3">
                                                           
                                                            <input type="text" class="form-control" placeholder="NAMA MAHASISWA" aria-label="Nama" aria-describedby="basic-addon1" name="namamhs">
                                                        </div>
                                                    </li>
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <div class="input-group mb-3">
                                                           
                                                            <input type="text" class="form-control" placeholder="NIM" aria-label="Nama" aria-describedby="basic-addon1" name="nim">
                                                        </div>
                                                    </li>
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <div class="input-group mb-3">
                                                           
                                                            <input type="text" class="form-control" placeholder="KATAGORI" aria-label="Nama" aria-describedby="basic-addon1" name="katagori">
                                                        </div>
                                                    </li>

                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <text>File Upload Max 10 MB</text>
                                                    </li>
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <div class="input-group mb-3">
                                                            <input type="file" class="form-control"  aria-describedby="basic-addon1" accepted="doc/pdf, image/jpg" name="berkas">
                                                        </div>
                                                    </li>
                                                    
                                                </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                      <!-- Modal footer -->
                          <div class="modal-footer">
                            <input type="submit" class="btn btn-danger" data-bs-dismiss="modal" value="upload"></input>
                          </div>
                        </form><!-- exit form -->
                      </div>
                    </div>
                  </div>
                </div>
        <!-- end Modal2 --> 
    <?php }?>
        <div class="container-fluid">

            <table class="table table-striped">
                <thead>
                    <tr>
                    		<th scope="col-sm-4">No</th>
                        <th scope="col-sm-4">Nama Mahasiswa</th>
                        <th scope="col-sm-4">NIM Mahasiswa</th>
                        <th scope="col-sm-8">Katagori Prestasi</th>
                        <th scope="col-sm-8">berkas</th>
                    </tr>
                </thead>
                
                <tbody class="table-striped">
                    <?php $a = 1; foreach($mhs as $value){ ?>
                    <tr>
                        <th scope="col-sm-4"><p class="text"><?php echo $a++; ?></p></th>
                        <th scope="col-sm-4"><p class="text"><?php echo $value['NAMA_MAHASISWA']; ?></p></th>
                        <th scope="col-sm-4"><p class="text"><?php echo $value['NIM_MHS']; ?></p></th>
                        <th scope="col-sm-4"><p class="text"><?php echo $value['KET_PRESTASI']; ?></p></th>
                        <th scope="col-sm-8">
                            <button class="btn btn-info" onclick="myFunction()" >Berkas</button>
                            <script>
                                function myFunction(){
                                    window.open("<?php echo site_url('Passing/showall') ?>/mahasiswa/<?php echo $value['BERKAS_MHS'];?> ")
                                }
                            </script>
                        </th>
                    </tr>   
                    <?php };?>                 
                </tbody>
            
            </table>
        </div>
        <!-- end page content -->
    </div>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="<?php echo base_url()?>assets/js/script.js"></script>
<script>
    
</script>
</body>
</html>
