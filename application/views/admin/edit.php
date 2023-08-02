<nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container container-fluid">
            <ul class="navbar-nav">
              <li class="nav-item">
                <button type="button" class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#Modal1">Insert Data</button>
              </li>
              <li class="nav-item">
                &nbsp;
              </li>
             
              <li class="nav-item">
                <button type="button" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#Modal1">search</button>
              </li>
              <li class="nav-item">
                &nbsp;
              </li>
              </ul>
          </div>
    </nav>
    <div class="container-fluid col-sm-8 col-xl-9">
             <!-- The Modal1 -->
                <div class="modal" id="Modal1">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Insert Data</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                            <form  action="<?php echo site_url('Backbone/createUser') ?>" method="post" >
                
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-xl-9 mx-auto">
                                        <div class="cta-inner bg-faded rounded">
                                            
                                            <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                        <input type="text" class="form-control" placeholder="Judul Penelitian" aria-label="Nama" aria-describedby="basic-addon1" name="Nama">
                                                    </div>
                                                </li>
                                                <text class="text text-primary">Tanggal submited</text>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <input type="date" class="form-control" placeholder="Tanggal Pelaksanaan" aria-label="Nip" aria-describedby="basic-addon1" name="Nip">
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">(*)</span>
                                                        <select class="form-control" placeholder="Prodi" name="Prodi">
                                                            <?php foreach ($set as $row ){ ?>
                                                            <option value="<?php echo $row->PAS_RULE;?>"><?php echo $row->RULE_PROD; ?></option>
                                                            <?php ;}?>
                                                        </select>
                                                    </div>
                                                </li> 
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">@</span>
                                                        <input type="text" class="form-control" placeholder="Nama Jurnal" aria-label="NamaJurnal" aria-describedby="basic-addon1" name="NamaJurnal">
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">#1</span>
                                                        <input type="text" class="form-control" placeholder="Akreditasi" aria-label="Password" aria-describedby="basic-addon1" name="akreditasi">
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">#2</span>
                                                        <input type="text" class="form-control" placeholder="Peneliti/anggota" aria-label="Password" aria-describedby="basic-addon1" name="Password2">
                                                    </div>
                                                </li>
                                                <text class="text text-primary">Upload berkas format pdf,jpg < 10mb</text>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" placeholder="Upload Berkas"  aria-describedby="basic-addon1" name="berkas">
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
                            <!-- end modal1 -->
        </div>

        <!-- Modal2 -->
        <div class="modal" id="Modal2">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Update Data</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                            <form  action="<?php echo site_url('Backbone/createUser') ?>" method="post" >
                
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col-xl-9 mx-auto">
                                        <div class="cta-inner bg-faded rounded">
                                            
                                            <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">+</span>
                                                        <input type="text" class="form-control" placeholder="Nama" aria-label="Nama" aria-describedby="basic-addon1" name="Nama">
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">+</span>
                                                        <input type="text" class="form-control" placeholder="NIP" aria-label="Nip" aria-describedby="basic-addon1" name="Nip">
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">+</span>
                                                        <select class="form-control" placeholder="Prodi" name="Prodi">
                                                            <?php foreach ($set as $row ){ ?>
                                                            <option value="<?php echo $row->PAS_RULE;?>"><?php echo $row->RULE_PROD; ?></option>
                                                            <?php ;}?>
                                                        </select>
                                                    </div>
                                                </li> 
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">@</span>
                                                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="Username">
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">#</span>
                                                        <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="Password">
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">#</span>
                                                        <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Password" aria-describedby="basic-addon1" name="Password2">
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

<?php foreach ($data as $row ){ ?>

            
                <!-- Page content-->
 
        <div class="container-fluid">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col-sm-1">No</th>
                        <th scope="col-sm-4">Judul Penelitian</th>
                        <th scope="col-sm-2">Tahun Terbit</th>
                        <th scope="col-sm-2">Penerbit</th>
                        <th scope="col-sm-2">Akreditasi</th>
                        <th scope="col-sm-2">Action</th>
                    </tr>
                </thead>
                <tbody class="text-muted">
                    <tr>
                        <th scope="col-sm-1">1</th>
                        <th scope="col-sm-4">Study Literatur</th>
                        <th scope="col-sm-2">Membuat Sesuatu yang terlalu sesuatu sekali </th>
                        <th scope="col-sm-2">No 4 tahun 2022</th>
                        <th scope="col-sm-2">ini link nya</th>
                        <th scope="col-sm-1"><text class="text-primary">print</text>/<text class="text-danger">delete</text>/<text class="text-dark">edit</text></th>
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

</body><?php }?>
</html>
