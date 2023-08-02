   
 <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
          <div class="container container-fluid">
            <ul class="navbar-nav">
              <li class="nav-item">
                <button type="button" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#Modal2">Surat Dinas Departemen</button>
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
                        <h4 class="modal-title">Insert Data Surat Departemen</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                            <?php echo form_open_multipart('source_in_out/insertsurat')?>
                
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-xl-9 mx-auto">
                                        <div class="cta-inner bg-faded rounded">
                                            
                                            <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Jenis Surat</span>
                                                        <select class="form-control" placeholder="jenissurat" name="jenissurat">
                                                            <?php foreach ($surat as $row ){ ?>
                                                            <option value="<?php echo $row->ID_JENIS_SURAT; ?>"><?php echo $row->JENIS_SURAT; ?></option>

                                                            <?php ;}?>

                                                        </select>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Tujuan</span>
                                                        <select class="form-control" placeholder="jenissurat" name="idprodi">
                                                            <?php foreach ($namaprodi as $row ){ ?>
                                                            <option value="<?php echo $row->ID_PRODI; ?>"><?php echo $row->NAMA_PRODI; ?></option>

                                                            <?php ;}?>

                                                        </select>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Tanggal Surat</span>
                                                        <input type="date" class="form-control" placeholder="tanggal" name="tanggal">
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Nomor Surat</span>
                                                        <input type="text" class="form-control" placeholder="Nomor Surat" name="nomor_surat">
                                                        </input>
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Perihal Surat</span>
                                                        <input type="text" class="form-control" placeholder="Perihal" name="perihal">
                                                        </input>
                                                    </div>
                                                </li>
                                                <?php foreach($data as $id){ ?>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                  <input class="form-check-input" type="hidden" value="<?php echo $id['ID_PRODI']?>"  name="idpengirim" /> <?php };?>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                  <input class="form-check-input" type="checkbox" value="zip" id="flexCheckDefault" name="tipe">RAR/ZIP</li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <input class="form-check-input" type="checkbox" value="pdf" id="flexCheckDefault" name="tipe">PDF
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    File Upload Maximal 10 Mb
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" placeholder="LAMPIRAN BERKAS" aria-label="berkassurat" aria-describedby="basic-addon1" name="berkassurat">
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
                        
        <div class="container-fluid row col-sm-6">
            <?php echo form_open_multipart('Passing/searchsurat')?>
              <div class="row">
                <div class="col">
                    <select class="form-control" placeholder="jenissurat" name="searchsurat">
                        <option selected>Open this search menu</option>
                        <?php foreach ($surat as $row ){ ?>
                            <option value="<?php echo $row->ID_JENIS_SURAT; ?>"><?php echo $row->JENIS_SURAT; ?></option><?php ;}?>
                    </select>
                </div>
                <div class="col-sm-3">
                  <button type="submit" class="form-control btn btn-info" placeholder="Last name">Search</button>
                </div>
              </div>
            </form>
        </div>
        <div>&nbsp;</div>
        <div class="content">
            <table class="table table-striped">
                <thead>
                    <tr class="bg-success">
                        <th scope="col-sm-1">No</th>
                        <th scope="col-sm-4">Nomor Surat</th>
                        <th scope="col-sm-2">Tanggal</th>
                        <th scope="col-sm-2">Prodi</th>
                        <th scope="col-sm-2">Perihal</th>
                        <th scope="col-sm-3">Berkas</th>
                    </tr>
                </thead>
                <tbody class="text-muted">
                    <?php
                        $a = 1;

                         foreach ($persuratan as $key) { ?>
                    <tr>
                        <th scope="col-sm-1"><p class="text-capitalize"><?php echo $a++;?></p></th>
                        <th scope="col-sm-11"><p class="text-capitalize"><?php echo $key['NO_SURAT'];?></p></th>
                        <th scope="col-sm-11"><p class="text-capitalize"><?php echo $key['TANGGAL_SURAT'];?></p></th>
                        <th scope="col-sm-11"><p class="text-capitalize"><?php echo $key['NAMA_PRODI'];?></p></th>
                        <th scope="col-sm-11"><p class="text-capitalize"><?php echo $key['PERIHAL_SURAT'];?></p></th>
                        <th scope="col-sm-11">
                            <button class="btn btn-primary"><a style="text-decoration: none" href="<?php echo site_url('Passing/showall') ?>/persuratan/<?php echo $key['LOKASI_SURAT'];?>/pdf"><text class="text-white">View</text></a></button>
                           <!-- <button class="btn btn-danger"><a style="text-decoration: none" href="#"><text class="text-white">Edit</text></a></button> -->
                           
                        </th>

                    </tr>
                    <?php };?>
                </tbody>
            </table>
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
