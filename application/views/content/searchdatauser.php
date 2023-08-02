<div>&nbsp;</div>
<div class="container alert-info">
    <div class="container container-fluid">
        <form class="row g-3" method="post" action="<?php echo site_url('Passing/profile')?>/search#!<?php echo hash('sha256',$_SESSION['user'])?>" >
              <div class="col-auto">
                <label for="staticEmail2" class="visually-hidden">sk</label>
                <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Search Berkas SK">
              </div>
              <div class="col-auto">
                <select class="form-select" aria-label="Default select example" name="cari">
                    <option selected>Open this search menu</option>
                      <?php foreach ($jenissk as $key => $value) { ?>
                      
                    <option value="<?php echo $value->JENIS_SK; ?>"><?php echo $value->JENIS_SK; ?></option>
                      <?php }; ?>
                </select>
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Confirm search</button>
              </div>
        </form>
    </div>
    
</div>
<script src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/js/bootstrap.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/js/jquery-ui.js'?>" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="<?php echo base_url()?>assets/js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#pegawai").autocomplete({
            source: "<?php echo site_url('Passing/searchpegawai');?>"
        });
    });
</script>