
<div class="container-fluid">
    <div class="row">
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title">Edit User Account </div>
            <div class="cta-inner bg-faded rounded">

                    <form action="#" method="post">
                  <?php foreach ($userlog as $value){?>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Username</span>
                        <input type="text" class="form-control" placeholder="<?php echo $value['LOGIN_USER'];?>" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Password</span>
                        <input type="text" class="form-control" placeholder="<?php echo $value['LOGIN_PASS'];?>" aria-label="password" aria-describedby="basic-addon1">
                    </div>
                      <?php }; ?>
                    
                      <?php foreach ($data as $key){ ?>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Email</span>
                        <input type="text" class="form-control" placeholder="<?php echo $key['E_MAIL']; ?>" aria-label="email" aria-describedby="basic-addon1">
                    </div>
                      <?php }; ?>
                      <div class="form-group mr-3">
                        <button type="submit" class="btn btn-danger">EDIT USER</button> 
                      </div>
                    </form>
              </div>
          </div></div></div>
    

    <?php foreach ($datauser as $row ){ ?>
          <div class="col-sm-8">
            <div class="card">
              <div class="card-body">
                  <div class="cta-inner bg-faded rounded">
                    <ul class="list-group">
                        <li class="list-group-item bg-secondary">ALL DATA USER</li>
                        <li class="list-group-item"><?php echo $row ['NAMA_PEGAWAI'];?></li>
                        <li class="list-group-item"><?php echo $row['NIP_PEGAWAI'];?></li>
                        <li class="list-group-item"><?php echo $row['GOLONGAN'];?></li>
                        <li class="list-group-item"><?php echo $row['NAMA_PRODI'];?></li>
                        <li class="list-group-item"><?php echo $row['NO_TLP'];?></li>
                        <li class="list-group-item"><?php echo $row['E_MAIL'];?></li>
                        <li class="list-group-item"><?php echo $row['ALAMAT'];?></li>
                        <li class="list-group-item"><?php echo $row['TMT'];?></li>
                    </ul>   
                  </div>
              </div>
            </div>
        </div>
        <?php }; ?>
      </div>


