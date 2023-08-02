
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
          <div class="container container-fluid">
            <ul class="navbar-nav">
              <li class="nav-item">
                <button type="button" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#Modal2">Update</button>
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
        <!--table data user-->
        
            
        <div>&nbsp;</div>
        <div class="container-fluid">
            <div class="container-fluid bg-secondary">
                <text class='text-left text-default'>DATA LOGIN USER APP</text>
            </div>
            <table class="table caption-top ">
                <thead>
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
                     <?php foreach ($data as $value) { ?>
                    <tr>
                        <th scope="col-sm-1"><?php echo $value->NAMA_PEGAWAI; ?></th>
                        <th scope="col-sm-4"><?php echo $value->LOGIN_USER; ?></th>
                        <th scope="col-sm-2"><?php echo $value->NIP_PEGAWAI; ?></th>
                        <th scope="col-sm-2"><?php echo $value->RULE_PROD; ?></th>
                        <th scope="col-sm-2"><?php echo $value->LOGIN_PASS; ?></th>
                        <th scope="col-sm-1"><text class="text-danger">delete</text>/<text class="text-dark">edit</text></th>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
          
        </div>
        <!-- end table user-->
       <!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="<?php echo base_url()?>assets/js/script.js"></script>

</body>
</html>