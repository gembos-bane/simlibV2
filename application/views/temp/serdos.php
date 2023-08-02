
<?php foreach ($data as $row ){ ?>    
                <!-- Page content-->
        <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
          <div class="container container-fluid">
            <ul class="navbar-nav">
              <li class="nav-item">
                <button type="button" class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#Modal2">Tambah Data Serdos</button>
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
                        <h4 class="modal-title">Tambah Data</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                            <?php echo form_open_multipart('source_in_out/inputserdos')?>
                
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-xl-9 mx-auto">
                                        <div class="cta-inner bg-faded rounded">
                                                <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" placeholder="Nama Sertifikat" aria-label="Nama" aria-describedby="basic-addon1" name="sertifikat">
                                                        </div>
                                                    </li>
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" placeholder="No Sertifikat" aria-label="Nama" aria-describedby="basic-addon1" name="nosertifikat">
                                                        </div>
                                                    </li>
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <text>Tanggal Pelaksanaan</text>
                                                    </li>
                                                        <div class="input-group mb-3">
                                                            <input type="date" class="form-control" placeholder="Tanggal Plaksanaan" aria-label="Nama" aria-describedby="basic-addon1" name="tanggal">
                                                        </div>
                                                    </li>
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" placeholder="Intansi Penyelenggara" aria-label="Nama" aria-describedby="basic-addon1" name="intansi">
                                                        </div>
                                                    </li>
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <text class="fst-italic text-lowercase">File Upload bukti Pengmas Max 10 MB</text>
                                                    </li>
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <div class="input-group mb-3">
                                                            <input type="file" class="form-control" placeholder="LAMPIRAN BERKAS" aria-label="berkas" aria-describedby="basic-addon1" name="berkas">
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
            </div>
        <!-- end Modal2 --> 

        <div class="container-fluid">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th scope="col-sm-1">No</th>
                        <th scope="col-sm-1">Nama Sertifikat</th>
                        <th scope="col-sm-4">No Sertifikat</th>
                        <th scope="col-sm-2">Tanggal Pelaksanaan</th>
                        <th scope="col-sm-2">Intansi</th>
                        <th scope="col-sm-2">Bukti/Link</th>
                    </tr>
                </thead>
                <tbody class="table-striped">

                    <?php 
                    $a = 1;
                    foreach($serdos as $row){?>
                    <tr>
                        <th scope="col-sm-1"><?php echo $a++;?></th>
                        <th scope="col-sm-2"><?php echo $row['NAMA_SERTIFIKAT'];?></th>
                        <th scope="col-sm-4"><?php echo $row['NO_SERTIFIKAT'];?> </th>
                        <th scope="col-sm-4"><?php echo $row['TGL_PELAKSANAAN_SERDOS'];?></th>
                        <th scope="col-sm-3"><?php echo $row['INTANSI'];?></th>
                        <th scope="col-sm-3">
                            <button class="btn btn-info" onclick="myFunction()">Berkas</button>
                            <script>
                                function myFunction(){
                                    window.open("<?php echo site_url('Passing/showall') ?>/serdos/<?php echo $row['LOKASI_BERKAS'];?> ")
                                }
                            </script>
                        </th>
                    </tr>
                    <?php }?>
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
