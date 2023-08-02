
<div class="container-fluid">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th scope="col-sm-1">No</th>
                        <th scope="col-sm-1">Judul Pengmas</th>
                        <th scope="col-sm-4">No SK Pelaksanaan</th>
                        <th scope="col-sm-2">Tgl Pelaksanaan</th>
                        <th scope="col-sm-2">Lokasi Pengmas</th>
                        <th scope="col-sm-2">Bukti</th>
                    </tr>
                </thead>
                <tbody class="table-striped">

                    <?php 
                    $a = 1; 
                    foreach($berkas as $row){?>
                    <tr>
                        <th scope="col-sm-1"><?php echo $a++;?></th>
                        <th scope="col-sm-2"><?php echo $row['JUDUL_PENGMAS'];?></th>
                        <th scope="col-sm-4"><?php echo $row['NO_SK'];?> </th>
                        <th scope="col-sm-4"><?php echo $row['TANGGAL_PELAKSANAAN'];?></th>
                        <th scope="col-sm-3"><?php echo $row['LOKASI'];?></th>
                        <th scope="col-sm-2">
                            <button class="btn btn-info" onclick="myFunction()">Berkas</button>
                            <script>
                                function myFunction(){
                                    window.open("<?php echo site_url('Passing/showall') ?>/pengmas/<?php echo $row['BUKTI'];?> ")
                                }
                            </script>
                        </th>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="fixed-bottom ">
                <div class="fixed-bottom ">
                  <center>
                    <nav aria-label="Page navigation example">
                      <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                          <?php echo $pagination; ?>
                        </li>
                      </ul>
                    </nav>
                  </center>
                </div>
              
        </div>
        <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>