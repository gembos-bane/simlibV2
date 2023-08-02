
<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button alert-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Berkas Kepegawaian Dosen Dan Tendik
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <!-- colapse content -->
        <div class="container overflow-hidden">
          <div class="content container-fluid">
          
          </div>
          <div class="container-fluid">&nbsp;</div>
          
          
              <table class="table table-hover">    
                <thead>
                    <tr class="alert-primary">
                        <th scope="col-sm-1">No</th>
                        <th scope="col-sm-4">Nama Pegawai</th>
                        <th scope="col-sm-2">Program Studi</th>
                        <th scope="col-sm-1">Berkas</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    <?php 
                    $a = 1;
                    foreach ($user as $key) { ?>
                    <tr>
                        <td scope="col-sm-1"><?php echo $a++;?></td>
                        <td scope="col-sm-4"><?php echo $key['NAMA_PEGAWAI'];?></td>
                        <td scope="col-sm-2"><?php echo $key['NAMA_PRODI'];?> </td>
                        <td scope="col-sm-1">
                            <a href="<?php echo base_url();?>Source_in_out/request/<?php echo $key['ID_PEGAWAI'];?>/<?php echo 12;?>/<?php echo $_SESSION['user']; ?>/R#!=<?php echo hash('sha256',$_SESSION['user'])?>" class="btn btn-info">Request Berkas</a>
                        </td>
                    </tr>
                    <?php }; ?>
                </tbody>
           </table>
              <p><?php echo $links; ?></p>      
        </div>
        
        <!-- end colaps content data pegawai -->
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed alert-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Berkas Penelitian 
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <div class="container overflow-hidden">
          <div class="row gy-5">

            <div class="col-4">
              <div class="p-3" >
                <center>
                  <div class="card alert-warning" style="width: 18rem; height: 12rem;">
                    <div class="card-body text-dark">
                      <h5 class="card-title">BERKAS <?php echo $teliti[0];?></h5>
                      <p class="card-text">Berkas Penelitian Dosen Prodi <?php foreach($dataprodi as $prodi){
                          echo $prodi->NAMA_PRODI;
                              } ?></p>
                      <a href="<?php echo base_url();?>Source_in_out/outdataallberkas/<?php echo $key['ID_PRODI'];?>/<?php echo $teliti[0];?>/sk#!=<?php echo hash('sha256',$_SESSION['user'])?>" class="btn btn-light">Go To Berkas</a>
                    </div>
                  </div>
                </center>
              </div>
            </div>
            <div class="col-4">
              <div class="p-3" >
                <center>
                  <div class="card alert-danger" style="width: 18rem; height: 12rem;">
                    <div class="card-body text-dark">
                      <h5 class="card-title">BERKAS <?php echo $teliti[1];?></h5>
                      <p class="card-text">Berkas Pengmas Dosen Prodi <?php foreach($dataprodi as $prodi){
                          echo $prodi->NAMA_PRODI;
                      } ?></p>
                      <a href="<?php echo base_url();?>Source_in_out/outdataallberkas/<?php echo $key['ID_PRODI'];?>/<?php echo $teliti[1];?>/sk#!=<?php echo hash('sha256',$_SESSION['user'])?>" class="btn btn-light">Go To Berkas</a>
                    </div>
                  </div>
                </center>
              </div>
            </div>
            <div class="col-4">
              <div class="p-3" >
                <center>
                  <div class="card alert-info" style="width: 18rem; height: 12rem;">
                    <div class="card-body text-dark">
                      <h5 class="card-title">BERKAS <?php echo $teliti[2];?></h5>
                      <p class="card-text">Berkas serdos Dosen Prodi <?php foreach($dataprodi as $prodi){
                          echo $prodi->NAMA_PRODI;
                      } ?></p>
                      <a href="<?php echo base_url();?>Source_in_out/outdataallberkas/<?php echo $key['ID_PRODI'];?>/<?php echo $teliti[2];?>/sk#!=<?php echo hash('sha256',$_SESSION['user'])?>" class="btn btn-light">Go To Berkas</a>
                    </div>
                  </div>
                </center>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

