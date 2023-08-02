
        
       

    
 <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
          <div class="container container-fluid">
            <ul class="navbar-nav">
              <li class="nav-item">
                <button type="button" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#Modal2">INSERT BERKAS SK</button>
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
                        <h4 class="modal-title">Insert Data SK Akademik PRODI</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                            <?php echo form_open_multipart('source_in_out/insertdatask')?>
                
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-xl-9 mx-auto">
                                        <div class="cta-inner bg-faded rounded">
                                            
                                            <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Jenis SK</span>
                                                        <select class="form-control" placeholder="jenissk" name="jenissk">
                                                            <?php foreach ($outsk as $row ){ ?>
                                                            <option value="<?php echo $row->ID_JENIS_SK; ?>"><?php echo $row->JENIS_SK; ?></option>
                                                            <?php ;}?>
                                                        </select>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Tahun SK</span>
                                                        <select class="form-control" placeholder="Prodi" name="tahun">
                                                            <?php foreach ($outtahun as $row ){ ?>
                                                            <option value="<?php echo $row->TAHUN_AKADEMIK; ?>"><?php echo $row->TAHUN_AKADEMIK; ?></option>
                                                            <?php ;}?>
                                                        </select>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Semester</span>
                                                        <select class="form-control" placeholder="Prodi" name="semester">
                                                            <?php foreach ($semester as $row ){ ?>
                                                            <option value="<?php echo $row->SEMESTER; ?>"><?php echo $row->SEMESTER; ?></option>
                                                            <?php ;}?>
                                                        </select>
                                                    </div>
                                                </li>
                                                <?php foreach($data as $id){ ?>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                  <input class="form-check-input" type="hidden" value="<?php echo $id['ID_PRODI']?>"  name="idprodi" /> <?php };?>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                  <input class="form-check-input" type="checkbox" value="zip" id="flexCheckDefault" name="tipe">RAR/ZIP</li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <input class="form-check-input" type="checkbox" value="pdf" id="flexCheckDefault" name="tipe">PDF
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    File Upload Maximal 10 Mb bentuk pdf
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" placeholder="LAMPIRAN BERKAS" aria-label="berkassk" aria-describedby="basic-addon1" name="berkassk">
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <input type="hidden" class="form-control" placeholder="LAMPIRAN BERKAS" aria-label="berkassk" aria-describedby="basic-addon1" name="prodi" value="<?php ?>">
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

        <!-- end page content -->
    
           <!-- Page content-->
                        
        <div class="container-fluid">
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col-sm-1">No</th>
                        <th scope="col-sm-4">Nama SK</th>
                        <th scope="col-sm-2">Tahun SK</th>
                        <th scope="col-sm-2">Semester</th>
                        <th scope="col-sm-3">Berkas</th>
                    </tr>
                </thead>
                <tbody class="text-muted">
                    <?php
                        $a = 1;

                         foreach ($user as $key) { ?>
                    <tr>
                        <th scope="col-sm-1"><p class="text-capitalize"><?php echo $a++;?></p></th>
                        <th scope="col-sm-11"><p class="text-capitalize"><?php echo $key['NAMA_MHS'].'-'.$key['JENIS_SK'];?></p></th>
                        <th scope="col-sm-11"><p class="text-capitalize"><?php echo $key['TAHUN_AKD'];?></p></th>
                        <th scope="col-sm-11"><p class="text-capitalize"><?php echo $key['SEMESTER'];?></p></th>
                        <th scope="col-sm-11">
                            <button class="btn btn-info" onclick="myFunction()">View</button>
                            <script>
                                function myFunction(){
                                    window.open("<?php echo site_url('Passing/showall') ?>/skmengajar/<?php echo $key['LOKASI_BERKAS'];?> ")
                                }
                            </script>
                            
                        </th>

                    </tr>
                    <?php };?>
                </tbody>
            </table>
            <p class="pagination pagination-item"><?php echo $links; ?></p>
        </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="<?php echo base_url()?>assets/js/script.js"></script>
<script>
    
</script>
</body>
</html>
