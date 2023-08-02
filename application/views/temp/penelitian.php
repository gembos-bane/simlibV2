

<?php foreach ($data as $row ){ ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
          <div class="container container-fluid">
            <ul class="navbar-nav">
              <li class="nav-item">
                <button type="button" class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#Modal2">Update / Tambah Data Penelitian</button>
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
                        <h4 class="modal-title">Update Data Penelitian</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                            <?php echo form_open_multipart('source_in_out/inputpenelitian')?>
                
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-xl-9 mx-auto">
                                        <div class="cta-inner bg-faded rounded">
                                                <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" placeholder="Judul Penelitian" aria-label="Nama" aria-describedby="basic-addon1" name="judulpenelitian">
                                                        </div>
                                                    </li>
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <text>Tanggal Penelitian</text>
                                                    </li>
                                                        <div class="input-group mb-3">
                                                            <input type="date" class="form-control" placeholder="Tanggal Penulisan" aria-label="Nama" aria-describedby="basic-addon1" name="tanggalpenulisan">
                                                        </div>
                                                    </li>
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" placeholder="N0 SK" aria-label="Nama" aria-describedby="basic-addon1" name="NoSK">
                                                        </div>
                                                    </li>
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" placeholder="Nama Jurnal" aria-label="Nama" aria-describedby="basic-addon1" name="jurnal">
                                                        </div>
                                                    </li>
                                                    <li class="list-unstyled-item list-hours-item d-flex">
                                                        <text class="fst-italic text-lowercase">File Upload bukti Penelitian Max 10 MB</text>
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
        <!-- end Modal2 --> 
    
        <div class="container">
            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                        <th scope="col-sm-1">NO</th>
                        <th scope="col-sm-4">JUDUL PENELITIAN</th>
                        <th scope="col-sm-4">JURNAL</th>
                        <th scope="col-sm-3">BERKAS PENDUKUNG</th>
                    </tr>
                </thead>
                <tbody class="text-muted">
                    <?php $a = 1;
                        foreach($teliti as $row){
                    ?>
                    <tr>
                        <td scope="col-sm-1"><p class="text text-start"><?php echo $a++;?></p></td>
                        <td scope="col-sm-4"><p class="text text-start"><?php echo $row['JUDUL_PENELITIAN'];?></p></td>
                        <td scope="col-sm-4"><p class="text text-start"><?php echo $row['NAMA_JURNAL'];?></p></td>
                        <td scope="col-sm-8">
                            <button class="btn btn-info" onclick="myFunction()" >Berkas</button>
                            <script>
                                function myFunction(){
                                    window.open("<?php echo site_url('Passing/showall') ?>/penelitian/<?php echo $row['BERKAS_PENELITIAN'];?> ")
                                }
                            </script>
                        </td>
                    </tr>
                        <?php } ;?>             
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
