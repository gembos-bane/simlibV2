
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
          <div class="container container-fluid">
            <ul class="navbar-nav">
              <li class="nav-item">
                <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#Modal1">create</button>
              </li>
              <li class="nav-item">
                &nbsp;
              </li>
              <li class="nav-item">
                <button type="button" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#Modal2">Update</button>
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
                        <h4 class="modal-title">Create New Account</h4>
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
                                                        <span class="input-group-text" id="basic-addon1">(*)</span>
                                                        <select class="form-control" placeholder="Prodi" name="Prodi">
                                                            <?php foreach ($level as $row ){ ?>
                                                            <option value="<?php echo $row->PAS_RULE;?>"><?php echo $row->RULE_PROD; ?></option>
                                                            <?php ;}?>
                                                        </select>
                                                    </div>
                                                </li> 
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">(*)</span>
                                                        <select class="form-control" placeholder="nama_prodi" name="id_nam_prod">
                                                            <?php foreach ($prodi as $row ){ ?>
                                                            <option value="<?php echo $row->ID_PRODI;?>"><?php echo $row->NAMA_PRODI; ?></option>
                                                            <?php ;}?>
                                                        </select>
                                                    </div>
                                                </li> 
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">TLP</span>
                                                        <input type="text" class="form-control" placeholder="No Telp" aria-label="Tlp" aria-describedby="basic-addon1" name="tlp">
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">email</span>
                                                        <input type="text" class="form-control" placeholder="Email" aria-label="email" aria-describedby="basic-addon1" name="email">
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
                                                        <span class="input-group-text" id="basic-addon1">#1</span>
                                                        <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="Password">
                                                    </div>
                                                </li>
                                                <li class="list-unstyled-item list-hours-item d-flex">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">#2</span>
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
                            <!-- end modal1 -->
        </div>

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
                                                            <?php foreach ($level as $row ){ ?>
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
        <!--table data user-->
        
            
        <div>&nbsp;</div>
        <div class="container-fluid">
            <div class="container-fluid">
                <text class='text-left text-default'>DATA LOGIN USER APP</text>
            </div>
            <table class="table table-striped caption-top ">
                <thead class="bg-info">
                    <tr>
                        <th scope="col-sm-4">Nama</th>
                        <th scope="col-sm-2">Username</th>
                        <th scope="col-sm-2">NIP/NIK</th>
                        <th scope="col-sm-2">Rule User</th>
                        <th scope="col-sm-2">Password</th>
                        <th scope="col-sm-2">Action</th>
                    </tr>
                </thead>
                <tbody class="text-muted">
                     <?php foreach ($login as $key => $value) { ?>
                    <tr>
                        <th scope="col-sm-1"><?php echo $value->NAMA_PEGAWAI; ?></th>
                        <th scope="col-sm-4"><?php echo $value->LOGIN_USER; ?></th>
                        <th scope="col-sm-2"><?php echo $value->NIP_PEGAWAI; ?></th>
                        <th scope="col-sm-2"><?php echo $value->RULE_PROD; ?></th>
                        <th scope="col-sm-2"><?php echo $value->LOGIN_PASS; ?></th>
                        <th scope="col-sm-1"><text><a href="<?php echo site_url('Passing/adminPassing')?>/delete/<?php echo $value->ID_LOGIN ?>/<?php echo hash('sha256',$value->NAMA_PEGAWAI)?>" class="text text-danger">delete</a></text>/<text><a href="<?php echo site_url('Passing/adminPassing')?>/editUpdate/<?php echo $value->ID_LOGIN;?>/<?php echo hash('sha256',$value->NAMA_PEGAWAI)?>" class="text text-primary">edit</a></text></th>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <p><?php echo $links;?></p>
        </div>
        <!-- end table user-->
       <!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="<?php echo base_url()?>assets/js/script.js"></script>

</body>
</html>