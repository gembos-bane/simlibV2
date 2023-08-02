


    <div class="container-fluid col-sm-8 col-xl-11">
              
        <div class="container-fluid">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col-sm-2">N0</th>
                        <th scope="col-sm-2">Tahun SK</th>
                        <th scope="col-sm-2">Semester</th>
                        <th scope="col-sm-8">Berkas Pendukung</th>
                    </tr>
                </thead>
                
                <tbody class="table-striped">
                    <?php $a=1;foreach($data as $value){ ?>
                    <tr>
                        <th scope="col-sm-4"><p class="text"><?php echo $a++; ?></p></th>
                        <th scope="col-sm-4"><p class="text"><?php echo $value['TAHUN_AKD'];?></p></th>
                        <th scope="col-sm-4"><p class="text"><?php echo $value['SEMESTER'];?></p></th>
                        <th scope="col-sm-8">
                            <a href="<?php echo site_url('Passing/showall') ?>/skmengajar/<?php echo $value['LOKASI_BERKAS'];?>/<?php echo $value['TYPE_FILE'];?>/1 " target="blank"><button class="btn btn-info">Berkas</button></a>
                        </th>
                    </tr>   
                    <?php };?>                 
                </tbody>
            
            </table>
        </div>
        <!-- end page content -->
    </div>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="<?php echo base_url()?>assets/js/script.js"></script>
<script>
    
</script>
</body>
</html>
