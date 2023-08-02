

<div class="row justify-content-center">
<div class="card">
  <div class="card-header alert-secondary">
    <?php foreach ($data as $row ){ ?>                            
    Bukti Borang Akreditasi Prodi <?php echo $row['NAMA_PRODI']; ?> 
    <?php } ?>
  </div>
    <div class="card-body">
      <div class="cta-inner bg-faded rounded">
        <div class="d-grid gap-4">
          <?php foreach ($borang as $key) { ?>
           <a href="<?php echo site_url('Akreditasi/outbuktiakk');?>/<?php echo $key->ID_BORANG;?>/Bukti_borang/<?php echo $key->STANDART;?>"><button class="btn alert-info" type="button">BUKTI - <?php echo $key->STANDART.' '.$key->NAMA_BORANG;?> (file .doc | jpeg  | pdf)</button></a>
          <?php } ?>
        </div>
         
        </div>
      </div>
    </div>
  </div>


           