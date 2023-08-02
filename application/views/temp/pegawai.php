
<?php foreach ($data as $row ){ ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
          <div class="container container-fluid">
            <ul class="navbar-nav">
              <li class="nav-item">
                <button type="button" class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#Modal2">Update data SK/Sertifikat</button>
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
                        <h4 class="modal-title">Update Account</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                           <?php echo form_open_multipart('source_in_out/doupload')?>
                
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
                                                           
                                                            <input type="text" class="form-control" placeholder="NAMA SK/SERTIFIKAT Pelatihan" aria-label="Nama" aria-describedby="basic-addon1" name="Namask">
                                                        </div>
                                                    </li>
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <text>Tahun SK/Sertifikat Dikeluarkan</text>
                                                    </li>
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <div class="input-group mb-3">
                                                           
                                                            <input type="date" class="form-control" placeholder="Tahun SK" aria-label="Nama" aria-describedby="basic-addon1" name="tahunSK">
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
    
        <div class="container-fluid">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col-sm-4">List Data Kepegawaian</th>
                        <th scope="col-sm-4">Tahun Penenetapan</th>
                        <th scope="col-sm-8">Berkas Pendukung</th>
                    </tr>
                </thead>
                
                <tbody class="table-striped">
                    <?php foreach($berkas as $value){ ?>
                    <tr>
                        <th scope="col-sm-4"><p class="text"><?php echo $value['NAMA_BERKAS']; ?></p></th>
                        <th scope="col-sm-4"><p class="text"><?php echo $value['TAHUN_SK']; ?></p></th>
                        <th scope="col-sm-8">
                            <button class="btn btn-info" onclick="myFunction()" >Show</button>
                            <script>
                                function myFunction(){
                                    window.open("<?php echo site_url('Passing/showall') ?>/sk/<?php echo $value['FCPATH'];?> ")
                                }
                            </script>
                            <button class="btn btn-danger" onclick="mybutton()" >Delete</button>
                            <script>
                                function mybutton(){
                                    window.open("<?php echo site_url('Source_in_out/deldata') ?>/<?php echo $value['ID_BERKAS'] ?>/<?php echo $value['FCPATH'];?> ")
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
</body><?php }?>
</html>
