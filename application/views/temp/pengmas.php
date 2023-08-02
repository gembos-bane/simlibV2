
<?php foreach ($data as $row ){ ?>    
                <!-- Page content-->
        <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
          <div class="container container-fluid">
            <ul class="navbar-nav">
              <li class="nav-item">
                <button type="button" class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#Modal2">Tambah Data Pengmas</button>
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
                            <?php echo form_open_multipart('source_in_out/inputdatapengmas')?>
                
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-xl-9 mx-auto">
                                        <div class="cta-inner bg-faded rounded">
                                                <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" placeholder="Judul Pengmas" aria-label="Nama" aria-describedby="basic-addon1" name="Judul">
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
                                                            <input type="text" class="form-control" placeholder="N0 SK Pelaksanaan" aria-label="Nama" aria-describedby="basic-addon1" name="NoSK">
                                                        </div>
                                                    </li>
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" placeholder="Lokasi Pelaksanaan" aria-label="Nama" aria-describedby="basic-addon1" name="Lokasi">
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
                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Update</button>
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
                        <th scope="col-sm-1">Tgl Pelaksanaan</th>
                        <th scope="col-sm-4">Judul Pengmas</th>
                        <th scope="col-sm-2">Lokasi</th>
                        <th scope="col-sm-2">No SK</th>
                        <th scope="col-sm-2">Bukti</th>
                    </tr>
                </thead>
                <tbody class="table-striped">

                    <?php 
                    $a = 1;
                    foreach($pengmas as $row){?>
                    <tr>
                        <th scope="col-sm-1"><?php echo $a++;?></th>
                        <th scope="col-sm-2"><?php echo $row['TANGGAL_PELAKSANAAN'];?></th>
                        <th scope="col-sm-4"><?php echo $row['JUDUL_PENGMAS'];?> </th>
                        <th scope="col-sm-4"><?php echo $row['LOKASI'];?></th>
                        <th scope="col-sm-3"><?php echo $row['NO_SK'];?></th>
                        <th scope="col-sm-2">
                            <button class="btn btn-info" onclick="myFunction()">Berkas</button>
                            <script>
                                function myFunction(){
                                    window.open("<?php echo site_url('Passing/showall') ?>/pengmas/<?php echo $row['BUKTI'];?> ")
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
