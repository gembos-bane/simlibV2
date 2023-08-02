<div class="container">
	<div class="container container-fluid">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col-sm-1">NO</th>
                    <th scope="col-sm-4">NAMA SK</th>
                    <th scope="col-sm-2">TAHUN SK</th>
                    <th scope="col-sm-2">SEMESTER</th>
                    <th scope="col-sm-3">ACTION</th>
                </tr>
            </thead>
            <tbody>

            	<?php 
            	$no = 1;
            	foreach ($outsearch as $key => $value) {
            		?>
            	<tr>
                    <td scope="col-sm-1"><?php echo $no++;?></td>
                    <td scope="col-sm-4"><?php echo $value['JENIS_SK'];?></td>
                    <td scope="col-sm-2"><?php echo $value['TAHUN_AKD'];?></td>
                    <td scope="col-sm-2"><?php echo $value['SEMESTER'];?></td>
                    <td scope="col-sm-3">
                            <a href="<?php echo site_url('Passing/showall') ?>/skmengajar/<?php echo $value['LOKASI_BERKAS'];?>/<?php echo $value['TYPE_FILE'];?>/<?php echo $value['ID_JENIS_SK'];?> " target="blank"><button class="btn btn-info" >Berkas</button></a>
                            
                        </td>
                </tr>
            	<?php };?>
            </tbody>
        </table>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="<?php echo base_url()?>assets/js/script.js"></script>
<script>
    
</script>
</body>
</html>
