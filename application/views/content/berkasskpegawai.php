
<?php foreach ($berkaspegawai as $data => $value){ ?>    
  <nav>
      <div class="alert alert-primary" role="alert">
        <center class="text-capitalize">
          DATA PEGAWAI <?php echo $value['NAMA_PEGAWAI'];?>
        </center>
      </div>
    </nav>
  
<div class="container-fluid">
<div class="container px-4">
  <div class="row gx-5">
    <div class="col">
     <div class="p-3 border bg-light">
        <div class="card" style="width: 28rem;">
          <div class="card-body">
            <h5 class="card-title">Berkas Kepegawaian</h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $value['NAMA_PEGAWAI']?></h6>
              <p class="card-text">NIP : <?php echo $value['NIP_PEGAWAI']?></p>
              <p class="card-text">No Telp : <?php echo $value['NO_TLP']?></p>
              <p class="card-text">e-mail : <?php echo $value['E_MAIL']?></p>
              <p class="card-text">Alamat : <?php echo $value['ALAMAT']?></p>
              <p class="card-text">TMT : <?php echo $value['TMT']?></p>

            <a href="#" class="card-link">Full Versi</a>
            <a href="#" class="card-link">Another link</a>
          </div>
        </div>
     </div>
    </div>
<?php }; ?>
    <div class="col">
      <div class="p-3 border bg-light"><div class="card" style="width: 28rem;">
          <div class="card-body">
            <h5 class="card-title">SERTIFIKAT, SK, SURAT TUGAS</h5>
            <h6 class="card-subtitle mb-2 text-muted">Berkas Serifikat, SK, Surat Tugas </h6>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">NAMA SK, Sertifikat, ST</th>
                  <th scope="col">TAHUN</th>
                  <th scope="col">BERKAS</th>
                </tr>
              </thead>
              
              <tbody>
                <?php 
                $a = 1;
                foreach($berkasout as $outdata){
              ?>
                <tr>
                  <th scope="row"><?php echo $a++; ?></th>
                  <td><?php echo $outdata['NAMA_BERKAS'];?></td>
                  <td><?php echo $outdata['TAHUN_SK'];?></td>
                  <td><button class="btn btn-info" onclick="myFunction()" >link</button>
                      <script>
                          function myFunction(){
                              window.open("<?php echo site_url('Passing/showall') ?>/sk/<?php echo $outdata['FCPATH'];?> ")
                          }
                      </script>
                  </td>
                </tr>
              <?php }; ?>
              </tbody>
            </table>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" />
            <!-- Core theme JS -->
            <script src="<?php echo base_url();?>assets/js/script.js"></script>
            </script>
             
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div></div>