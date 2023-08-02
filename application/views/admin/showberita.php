<div class="card text-center">
  <div class="card-header">
    Breaking News
  </div>
  <?php foreach($berita as $row){?>
  <div class="card-body">
    <h5 class="card-title"><?php echo $row->JUDUL;?></h5>
    <p class="card-text"><?php echo $row->INFORMASI;?></p>
    <a href=" " class="btn btn-primary">confirm</a>
  </div>
  <div class="card-footer text-muted">
    This News Create On <?php echo $row->TANGGAL;?> by ADMIN
  </div>
<?php };?>
</div>