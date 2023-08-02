   
        <div>&nbsp;</div>
        <div class="container-fluid">
            <div class="container-fluid">
                <text class='text-left text-default'>DATA LOGIN USER ACTIVITY</text>
            </div>
            <div>&nbsp;</div>
            <div class="row">
                <div class="col-sm-8">
                    <table class="table table-striped caption-top ">
                        <thead class="bg-info">
                            <tr>
                                <th scope="col-sm-4">Nama</th>
                                <th scope="col-sm-2">NIP</th>
                                <th scope="col-sm-2">RULE</th>
                                <th scope="col-sm-2">WAKTU</th>
                                <th scope="col-sm-2">IP ADDRESS</th>
                            </tr>
                        </thead>
                        <tbody class="text-muted">
                             <?php foreach ($activity as $key => $value) { ?>
                            <tr>
                                <th scope="col-sm-1"><?php echo $value['NAMA_PEGAWAI']; ?></th>
                                <th scope="col-sm-4"><?php echo $value['NIP_PEGAWAI']; ?></th>
                                <th scope="col-sm-4"><?php echo $value['RULE_PROD']; ?></th>
                                <th scope="col-sm-2"><?php echo $value['TIME']; ?></th>
                                <th scope="col-sm-2"><?php echo $value['IP_ADDRESS']; ?></th>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
          </div>
        </div>
        <!-- end table user-->
       <!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="<?php echo base_url()?>assets/js/script.js"></script>

</body>
</html>