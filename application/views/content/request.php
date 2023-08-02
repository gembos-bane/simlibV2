
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
          <div class="row gy-5 col-sm-8">
            
              <table class="table table-bordered ">
                <thead>
                    <tr class="alert-primary">
                        <th scope="col-sm-1">No</th>
                        <th scope="col-sm-4">NAMA YANG MEREQUEST</th>
                        <th scope="col-sm-2">BERKAS DIMINTA</th>
                        <th scope="col-sm-1">PROSES</th>
                    </tr>
                </thead>
                <tbody class="table-striped">

                     
                    <?php 
                    $a = 1;
                    foreach ($request as $key) { ?>
                    <tr>
                        <td scope="col-sm-1"><?php echo $a++;?></td>
                        <td scope="col-sm-4"><?php echo $key['SENDER'];?></td>
                        <td scope="col-sm-2"><?php echo $key['MAILING'];?> </td>
                        <td scope="col-sm-1">
                            <a href="<?php echo base_url();?>Source_in_out/respons/<?php echo $key['ID_MAILING'];?>/<?php echo 1;?>/<?php echo $_SESSION['idpegawai']; ?>/R#!=<?php echo hash('sha256',$_SESSION['user'])?>" class="btn btn-success" onclick="isconfirm()">Setujui</a>
                            <a href="<?php echo base_url();?>Source_in_out/respons/<?php echo $key['ID_MAILING'];?>/<?php echo 2;?>/<?php echo $_SESSION['idpegawai']; ?>/R#!=<?php echo hash('sha256',$_SESSION['user'])?>" class="btn btn-danger" onclick="isconfirm()">Tolak</a>
                        </td>
                    </tr>
                    <?php }; ?>
                </tbody>
           </table>
          </div>
        </div>
        <!-- end colaps content data pegawai -->
    </div>
  </div>
</div>
</div>
<script>
  function isconfirm(){
  if(!confirm('Are you sure ?')){event.preventDefault();return;}
  return true;}
</script>